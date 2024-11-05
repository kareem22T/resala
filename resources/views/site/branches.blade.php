@extends('site.layouts.site-layout')

@section('title', 'الفروع')
@section('branches_active', 'active')

@section('styles')
    <style>
        .branches_wrapper {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 3rem 0 3rem;
        }

        .branches_wrapper .card {
            color: #ffffff;
            background-color: #27318b;
            padding: 1rem;
            margin-bottom: 0px;
            border-radius: 10px;
            box-shadow: 1px 10px 32px 0px rgba(72, 41, 160, 0.15);
            border: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .branches_wrapper .card h2 {
            display: flex;
            flex-direction: column;
            font-size: 22px;
            font-weight: 700;
            line-height: 30px;
        }

        .branches_wrapper .card h2 span {
            font-size: 16px;
            font-weight: 500;
        }

        .branches_wrapper .card>* {
            display: flex;
            gap: 1rem
        }

        .branches_wrapper .card>* i {
            font-size: 29px;
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.05);
            margin-right: 10px;
            gap: 1rem;
            border-radius: 4px;
            height: max-content;
            padding: 10px;
        }

        .pagination {
            margin: 2rem auto;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            direction: rtl !important
        }

        .page-link {
            border-radius: 10px !important;
            width: 40px;
            height: 40px;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #27318b !important;
        }

        .page-item.active .page-link {
            background: #e31b24;
            color: #fff !important;
            border-color: #e31b24 !important;
        }

        @media (max-width: 767.98px) {
            .branches_wrapper {
                grid-template-columns: 1fr
            }
        }

        .page-link.active {
            background: #e7212c !important;
            border-color: #e7212c !important;
            color: #fff !important;
        }
    </style>
@endsection

@section('content')
    <div id="app">
        <input type="text" v-model="searchQuery" placeholder="بحث عن فرع" class="form-control"
            style="max-width: 300px; margin: 1rem 0;">

        <div class="branches_wrapper" v-if="filteredBranches.length > 0">
            <div class="card" v-for="branch in paginatedBranches" :key="branch.id">
                <div class="address">
                    <i class="fa-solid fa-earth-africa"></i>
                    <h2>
                        @{{ branch.location }}
                        <span>@{{ branch.address }}</span>
                    </h2>
                </div>
                <div class="phone" style="margin-top: 10px;align-items:center;">
                    <i class="fa-solid fa-phone-flip"></i>
                    @{{ branch.phone }}
                </div>
            </div>
        </div>

        <div v-else>
            <h1 style="margin: 5rem 0">لا توجد فروع</h1>
        </div>

        <!-- Pagination controls -->
        <div class="pagination" dir="rtl" style="direction: rtl !important" v-if="filteredBranches.length > itemsPerPage">
            <button :disabled="currentPage === 1" @click="currentPage--" class="page-link"
                style="display: block;width: auto;height: auto;">السابق</button>

            <button v-for="page in pageNumbers" :key="page" @click="changePage(page)"
            :class="{ 'page-link': true, 'active': page === currentPage }">
            @{{ page }}
        </button>
        <button :disabled="currentPage === totalPages" @click="currentPage++" class="page-link"
            style="display: block;width: auto;height: auto;">التالي</button>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                branches: @json($branches),
                searchQuery: '',
                currentPage: 1,
                itemsPerPage: 10,
                maxVisiblePages: 4, // Maximum number of visible page numbers
            },
            computed: {
                filteredBranches() {
                    return this.branches.filter(branch =>
                        branch.location.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        branch.address.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        branch.phone.includes(this.searchQuery)
                    );
                },
                paginatedBranches() {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.filteredBranches.slice(start, end);
                },
                totalPages() {
                    return Math.ceil(this.filteredBranches.length / this.itemsPerPage);
                },
                pageNumbers() {
                    const pages = [];
                    const startPage = Math.max(1, this.currentPage - Math.floor(this.maxVisiblePages / 2));
                    const endPage = Math.min(this.totalPages, startPage + this.maxVisiblePages - 1);

                    for (let i = startPage; i <= endPage; i++) {
                        pages.push(i);
                    }
                    return pages;
                }
            },
            methods: {
                changePage(page) {
                    this.currentPage = page;
                }
            },
            watch: {
                searchQuery() {
                    this.currentPage = 1; // Reset to page 1 on new search
                }
            }
        });
    </script>
@endsection
