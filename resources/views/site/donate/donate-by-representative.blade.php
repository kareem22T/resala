@extends("site.layouts.site-layout")

@section('title', 'التبرع من خلال مندوب')

@section('styles')
    <style>
        section {
            padding: 2rem 0;
        }
        section >h1 {
            font-weight: 600;
            text-align: center;
            color: #27318b;
        }

        section .switch {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }
        section .switch label {
            padding: 1rem 2rem;
            border-style: solid;
            border-width: 1px;
            border-color: #c6c6c6;
            border-radius: 1rem;
            font-size: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.25rem 0 .7rem;
            translate: all .3s ease-in-out;
            cursor: pointer;
        }
        input[type="radio"] {
            display: none;
        }
        input[type="radio"]:checked +label {
            background: rgb(44,54,142);
            background: linear-gradient(0deg, rgba(44,54,142,1) 0%, rgba(82,90,162,1) 100%);
            color: #fff;
            border: none
        }
        form .form-group {
            display: flex;
            flex-direction: column;
            gap: .7rem;
            margin-top: 1rem;
            font-weight: 600;
        }
        section form button {
            background: rgb(44,54,142);
            padding: .7rem 2rem;
            border-radius: 1rem;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 1rem 0;
            border: none;
            color: #fff;
            widows: 150px
        }
        input, textarea {
            background: #ffffff8b !important;
            backdrop-filter: blur(10px) !important
        }
        @media (max-width: 575px) {
            section {
                padding: 0 0;
            }
            section .switch label {
                padding: .7rem 1.25rem;
                font-size: 1.1rem;
            }
        }
        .loader {
          width: 15px;
          aspect-ratio: 1;
          border-radius: 50%;
          animation: l5 1s infinite linear alternate;
        }
        .loader_wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #00000037;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        @keyframes l5 {
            0%  {box-shadow: 20px 0 #000, -20px 0 #0002;background: #000 }
            33% {box-shadow: 20px 0 #000, -20px 0 #0002;background: #0002}
            66% {box-shadow: 20px 0 #0002,-20px 0 #000; background: #0002}
            100%{box-shadow: 20px 0 #0002,-20px 0 #000; background: #000 }
        }
    </style>
@endsection

@section('content')
    <div class="loader_wrapper">
        <div class="loader"></div>
    </div>
    <section id="donate_by_representative">
        <h1>التبرع من خلال مندوب </h1>
        <div class="switch">
            <div class="form-group">
                <input type="radio" name="type" id="type_1" class="form-control" value="1" checked v-model="type">
                <label for="type_1">
                    <i class="bx bx-globe"></i>
                    <span>تبرع عيني</span>
                </label>
            </div>
            <div class="form-group">
                <input type="radio" name="type" id="type_2" class="form-control" value="2" v-model="type">
                <label for="type_2">
                    <i class="bx bx-pyramid"></i>
                    <span>تبرع مالي</span>
                </label>
            </div>
        </div>
        <form @submit.prevent>
            <div class="form-group">
                <label for="name">الاسم *</label>
                <input type="text" class="form-control" placeholder="الاسم" v-model="name">
            </div>
            <div class="form-group">
                <label for="name">رقم الهاتف *</label>
                <input type="text" class="form-control" placeholder="رقم الهاتف" v-model="phone">
            </div>
            <div class="form-group">
                <label for="name">العنوان *</label>
                <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="العنوان" v-model="address"></textarea>
            </div>
            <button @click="send()">ارسال</button>
        </form>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header" style="justify-content: space-between;width: 100%;display: flex;flex-direction: row;">
                    <h5 class="modal-title" id="thankYouModalLabel">شكرًا</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin: 0;"></button>
                </div>
                <div class="modal-body">
                    شكرًا لتبرعكم الكريم. سيتم التواصل معكم قريبًا لتنسيق موعد زيارة مندوبنا في أقرب وقت ممكن.
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="/" class="btn btn-primary">حسنا</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('/libs/axios.js') }}"></script>
    <script src="{{ asset('/libs/vue.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    const { createApp, ref } = Vue;

    createApp({
    data() {
        return {
            name: '',
            phone: '',
            address: '',
            type: 1,
        }
    },
    methods: {
        async send() {
        $('.loader_wrapper').fadeIn().css('display', 'flex');
        try {
            const response = await axios.post(`{{ route("donate.representative.send") }}`, {
                type: this.type,
                name: this.name,
                phone: this.phone,
                address: this.address,
            });
            if (response.data.status === true) {
                $('.loader_wrapper').fadeOut();

                // Show the modal on success
                const thankYouModal = new bootstrap.Modal(document.getElementById('thankYouModal'));
                thankYouModal.show();
                this.type = 1;
                this.name = '';
                this.phone = '';
                this.address = '';

            } else {
                $('.loader_wrapper').fadeOut();
                document.getElementById('errors').innerHTML = '';
                $.each(response.data.errors, function (key, value) {
                    let error = document.createElement('div');
                    error.classList = 'error';
                    error.innerHTML = value;
                    document.getElementById('errors').append(error);
                });
                $('#errors').fadeIn('slow');
            }
        } catch (error) {
            $('.loader_wrapper').fadeOut();
            console.error(error);
        }
    },
    },
    }).mount('#donate_by_representative')
    </script>
@endsection
