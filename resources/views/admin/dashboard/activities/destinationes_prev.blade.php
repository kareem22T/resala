@extends('admin.layouts.admin-layout')
@section('title', 'الانشطة')
@section('activites_preview_active', 'active')

@section('content')
<h3 class="mb-5">
    الانشطة
</h3>
<main id="destinations_prev">
    <div class="card w-100">
        <div class="card-header d-flex justify-content-between gap-3">
            <input type="text" name="search" id="search" class="form-control w-25" placeholder="بحث" v-model="search" @input="getSearch(this.search)">
            <a href="{{ route('activites.add') }}" class="btn btn-primary"><i class="ti ti-plus"></i> اضافة نشاط</a>
        </div>
        <div class="card-body p-4">
        <div class="table-responsive" v-if="destinations_data && destinations_data.length > 0">
            <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
                <tr>
                    {{-- <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0 d-inline-flex align-items-center">Id</h6>
                    </th> --}}
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0 d-inline-flex align-items-center">العنوان</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0 d-inline-flex align-items-center">الرابط</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0 d-inline-flex align-items-center">Controls</h6>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(destination, index) in destinations_data" :key="index">
                    {{-- <td class="border-bottom-0"><h6 class="fw-semibold mb-0">@{{destination.id}}</h6></td> --}}
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">@{{destination.title}}</h6></td>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">@{{destination.url}}/</h6></td>
                    <td class="border-bottom-0">
                        <div class="d-flex gap-2">
                            <a :href="`/${destination.url}`" target="_blanck" class="btn btn-success p-2"><h4 class="ti ti-eye text-light m-0 fw-semibold"></h4></a>
                            <a :href="`/admin/activites/edit/${destination.id}`" class="btn btn-secondary p-2"><h4 class="ti ti-edit text-light m-0 fw-semibold"></h4></a>
                            <button class="btn btn-danger p-2" @click="this.delete_pop_up = true; getValues(destination.id, destination.title)"><h4 class="ti ti-trash text-light m-0 fw-semibold"></h4></button>
                        </div>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="pagination w-100 d-flex gap-2 justify-content-center mt-3" v-if="last_page > 1">
            <div v-for="page_num in last_page" :key="page_num" >
                <label :for="`page_num_${page_num}`" class="btn btn-primary" :class="page_num == page ? 'active' : ''">@{{ page_num }}</label>
                <input type="radio" class="d-none" name="page_num" :id="`page_num_${page_num}`" v-model="page" :value="page_num" @change="search == '' ? getdestinations() : getSearch(this.search)">
            </div>
        </div>
        <h4 class="text-center">
            @{{ destinations_data && destinations_data.length == 0 ? 'لا توجد انشطة مضافة' : '' }}
        </h4>
        <h4 class="text-center">
            @{{ destinations_data === false ? 'Server error try again later' : '' }}
        </h4>
        </div>
        <div class="hide-content" v-if="delete_pop_up"></div>
        <div class="pop-up delete_pop_up card w-50" style="margin: auto; display: none;"  :class="{ 'show': delete_pop_up }" v-if="delete_pop_up">
            <div class="card-body">
                <form @submit.prevent>
                    <h5 class="mb-3 text-center">هل انت متاكد من حذف النشاط  @{{ destination_name }}؟</h5>
                    <div class="btns d-flex w-100 justify-content-between gap-3">
                        <button class="btn btn-light w-100" @click="delete_pop_up = false; getValus(null, null, null)">الغاء</button>
                        <button class="btn btn-danger w-100" @click="deletedestination(destination_id)">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="{{ asset('/libs/axios.js') }}"></script>
<script src="{{ asset('/libs/vue.js') }}"></script>

<script>
const { createApp, ref } = Vue;
createApp({
    data() {
        return {
            destination_id: null,
            destination_name: null,
            delete_pop_up: false,
            destinations_data: null,
            search: null,
            page: 1,
            total: null,
            last_page: null,
        }
    },
    methods: {
        async deletedestination(destination_id) {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route("activites.delete") }}`, {
                    destination_id: destination_id,
                },
                );
                if (response.data.status === true) {
                    document.getElementById('errors').innerHTML = ''
                    let error = document.createElement('div')
                    error.classList = 'success'
                    error.innerHTML = response.data.message
                    document.getElementById('errors').append(error)
                    $('#errors').fadeIn('slow')
                    $('.loader').fadeOut()
                    setTimeout(() => {
                        $('#errors').fadeOut('slow')
                        window.location.reload();
                    }, 2000);
                } else {
                    $('.loader').fadeOut()
                    document.getElementById('errors').innerHTML = ''
                    $.each(response.data.errors, function (key, value) {
                        let error = document.createElement('div')
                        error.classList = 'error'
                        error.innerHTML = value
                        document.getElementById('errors').append(error)
                    });
                    $('#errors').fadeIn('slow')
                    setTimeout(() => {
                        $('input').css('outline', 'none')
                        $('#errors').fadeOut('slow')
                    }, 5000);
                }

            } catch (error) {
                document.getElementById('errors').innerHTML = ''
                let err = document.createElement('div')
                err.classList = 'error'
                err.innerHTML = 'server error try again later'
                document.getElementById('errors').append(err)
                $('#errors').fadeIn('slow')
                $('.loader').fadeOut()

                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                }, 3500);

                console.error(error);
            }
        },
        async getdestinations() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route("activites.get") }}?page=${this.page}`, {
                },
                );
                if (response.data.status === true) {
                    $('.loader').fadeOut()
                    this.destinations_data = response.data.data.data
                    this.total = response.data.data.total
                    this.last_page = response.data.data.last_page
                } else {
                    $('.loader').fadeOut()
                    document.getElementById('errors').innerHTML = ''
                    $.each(response.data.errors, function (key, value) {
                        let error = document.createElement('div')
                        error.classList = 'error'
                        error.innerHTML = value
                        document.getElementById('errors').append(error)
                    });
                    $('#errors').fadeIn('slow')
                    setTimeout(() => {
                        $('input').css('outline', 'none')
                        $('#errors').fadeOut('slow')
                    }, 5000);
                }

            } catch (error) {
                document.getElementById('errors').innerHTML = ''
                let err = document.createElement('div')
                err.classList = 'error'
                err.innerHTML = 'server error try again later'
                document.getElementById('errors').append(err)
                $('#errors').fadeIn('slow')
                $('.loader').fadeOut()
                this.languages_data = false
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                }, 3500);

                console.error(error);
            }
        },
        async getSearch(search_words) {
            try {
                const response = await axios.post(`{{ route("activites.search") }}?page=${this.page}`, {
                    search_words: search_words,
                },
                );
                if (response.data.status === true) {
                    this.destinations_data = response.data.data.data
                    this.total = response.data.data.total
                    this.last_page = response.data.data.last_page
                } else {
                    document.getElementById('errors').innerHTML = ''
                    $.each(response.data.errors, function (key, value) {
                        let error = document.createElement('div')
                        error.classList = 'error'
                        error.innerHTML = value
                        document.getElementById('errors').append(error)
                    });
                    $('#errors').fadeIn('slow')
                    setTimeout(() => {
                        $('input').css('outline', 'none')
                        $('#errors').fadeOut('slow')
                    }, 5000);
                }

            } catch (error) {
                document.getElementById('errors').innerHTML = ''
                let err = document.createElement('div')
                err.classList = 'error'
                err.innerHTML = 'server error try again later'
                document.getElementById('errors').append(err)
                $('#errors').fadeIn('slow')
                $('.loader').fadeOut()
                this.languages_data = false
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                }, 3500);

                console.error(error);
            }
        },
        getValues(destination_id, destination_name) {
            this.destination_id = destination_id
            this.destination_name = destination_name
        }
    },
    created() {
        this.getdestinations()
        $('.loader').fadeOut()
    },
}).mount('#destinations_prev')
</script>
@endsection
