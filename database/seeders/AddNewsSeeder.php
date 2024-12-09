<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddNewsSeeder extends Seeder
{
    public function run()
    {
        // Fetch data from old WordPress database
        $articles = DB::connection('old_database')->table('wp_posts')->where('post_type', 'post')->get();

        foreach ($articles as $article) {
            // Insert processed article into the new database
            DB::table('articles')->insert([
                'title' => $article->post_title,
                'slug' => Str::slug($article->post_title),
                'content' => $this->processContent($article->post_content),
                'excerpt' => $article->post_excerpt,
                'created_at' => $article->post_date,
                'updated_at' => $article->post_modified,
            ]);
        }
    }

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

        // Replace [cz_gallery] shortcodes with album HTML
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
