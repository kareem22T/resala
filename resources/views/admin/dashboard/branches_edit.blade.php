@extends('admin.layouts.admin-layout')
@section('title', 'تعديل فرع')
@section('branches_preview_active', 'active')

@section('content')
<h3 class="mb-5">
    تعديل الفرع
</h3>
<main  id="branches_add">
    @if($branch)
        <div class="card w-100">
            <div class="card-body p-4">
                <form @submit.prevent>
                    <div class="form-group mb-3">
                        <label for="location">الموقع *</label>
                        <input type="text" name="location" id="location" v-model="location" class="form-control mt-2" placeholder="(القاهرة - مصر الجديدة)">
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">العنوان</label>
                        <input type="text" name="address" id="address" v-model="address"  class="form-control mt-2" placeholder="العنوان التفصيلي">
                    </div>
                    <button class="btn btn-primary" @click="update()">تعديل</button>
                </form>
            </div>
        </div>
    @else
        <h1 class="text-center">هذا الفرع لم يعد متواجد</h1>
    @endif
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
            location: "{{ $branch->location }}",
            address: "{{ $branch->address }}",
            id: "{{ $branch->id }}",
        }
    },
    methods: {
        async update() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route("branches.update") }}`, {
                    location: this.location,
                    address: this.address,
                    id: this.id,
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
                    }, 3500);

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
    },
    created() {
        $('.loader').fadeOut()
    },
}).mount('#branches_add')
</script>
@endsection
