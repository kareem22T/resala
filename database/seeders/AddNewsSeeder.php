<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('old_database')->table('wp_posts')
            ->where('post_status', 'publish')
            ->where('post_type', 'post')
            ->orderBy('ID')
            ->chunk(100, function ($oldArticles) {
                foreach ($oldArticles as $oldArticle) {
                    // Clean and process the content
                    $description = $this->processContent($oldArticle->post_content);

                    // Get thumbnail path
                    $thumbnail_id = DB::connection('old_database')->table('wp_postmeta')
                        ->where('meta_key', '_thumbnail_id')
                        ->where('post_id', $oldArticle->ID)
                        ->first()?->meta_value;

                    $thumbnail_path = DB::connection('old_database')->table('wp_posts')
                        ->where('ID', $thumbnail_id)
                        ->first()?->guid;

                    // Check categories
                    $isPost = DB::connection('old_database')->table('wp_term_relationships')
                        ->where([
                            "term_taxonomy_id" => 1,
                            "object_id" => $oldArticle->ID,
                        ])->exists();

                    $isVideo = DB::connection('old_database')->table('wp_term_relationships')
                        ->where([
                            "term_taxonomy_id" => 7,
                            "object_id" => $oldArticle->ID,
                        ])->exists();

                    $isPhotos = DB::connection('old_database')->table('wp_term_relationships')
                        ->where([
                            "term_taxonomy_id" => 11,
                            "object_id" => $oldArticle->ID,
                        ])->exists();

                    // Create the new article
                    if ($isPost) {
                        Article::create([
                            'author_id' => 1,
                            'title' => $oldArticle->post_title,
                            'content' => $description,
                            'thumbnail_path' => $thumbnail_path,
                            'type' => "post",
                            'url' => str_replace(' ', '-', $oldArticle->post_title),
                            'created_at' => $oldArticle->post_modified,
                        ]);
                    }
                    if ($isVideo) {
                        Article::create([
                            'author_id' => 1,
                            'title' => $oldArticle->post_title,
                            'content' => $description,
                            'thumbnail_path' => $thumbnail_path,
                            'type' => "video",
                            'url' => str_replace(' ', '-', $oldArticle->post_title),
                            'created_at' => $oldArticle->post_modified,
                        ]);
                    }
                    if ($isPhotos) {
                        Article::create([
                            'author_id' => 1,
                            'title' => $oldArticle->post_title,
                            'content' => $description,
                            'thumbnail_path' => $thumbnail_path,
                            'type' => "photos",
                            'url' => str_replace(' ', '-', $oldArticle->post_title),
                            'created_at' => $oldArticle->post_modified,
                        ]);
                    }
                }
            });
    }

    /**
     * Process the content to replace shortcodes and clean up HTML.
     */
    private function processContent(string $content): string
    {
        // Replace [gallery ids="..."] shortcode with gallery HTML
        $content = preg_replace_callback('/\[gallery ids="([^"]+)"\]/', function ($matches) {
            $ids = explode(',', $matches[1]);
            $html = '<div class="images-album" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; width: 100%;">';

            foreach ($ids as $id) {
                $imageUrl = DB::connection('old_database')->table('wp_posts')
                    ->where('ID', trim($id))
                    ->first()?->guid;

                if ($imageUrl) {
                    $html .= '<div class="img_wrapper" style="width: 100%; height: 300px;">
                                <img src="' . $imageUrl . '" alt="Gallery Image" style="width: 100%; height: 100%; object-fit: cover;">
                              </div>';
                }
            }

            $html .= '</div>';
            return $html;
        }, $content);

        // Replace cz_gallery shortcodes with album HTML
        $content = preg_replace_callback('/\[cz_gallery[^]]*images="([^"]+)"[^]]*\]/', function ($matches) {
            $ids = explode(',', $matches[1]);
            $html = '<div class="images-album" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; width: 100%;">';

            foreach ($ids as $id) {
                $imageUrl = DB::connection('old_database')->table('wp_posts')
                    ->where('ID', trim($id))
                    ->first()?->guid;

                if ($imageUrl) {
                    $html .= '<div class="img_wrapper" style="width: 100%; height: 300px;">
                                <img src="' . $imageUrl . '" alt="Gallery Image" style="width: 100%; height: 100%; object-fit: cover;">
                              </div>';
                }
            }

            $html .= '</div>';
            return $html;
        }, $content);

        // Replace [vc_row][vc_column][vc_column_text] shortcode with clean HTML
        $content = str_replace([
            '[vc_row]',
            '[vc_column]',
            '[vc_column_text]',
            '[/vc_column_text]',
            '[/vc_column]',
            '[/vc_row]'
        ], '', $content);

        // Strip any other shortcodes and strange codes
        $content = strip_tags($content, '<p><a><img><div><span><strong><em><ul><ol><li>');

        return $content;
    }
    }
