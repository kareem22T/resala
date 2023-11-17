@extends("site.layouts.site-layout")

@section('title', 'التطوع')

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
        section >p {
            text-align: center;
            font-size: 18px;
            line-height: 40px;
            color: #464646;
        }
        section >a {
            margin: auto;
            display: block;
            width: max-content;
            padding: 10px 20px;
            background: #e31b24;
            border: 2px solid #e31b24;
            transition: all .5s ease-in-out;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            border-radius: 1rem;
            font-size: 18px;
        }
        section >a:hover {
            background: transparent;
            color: #e31b24;
        }
        section .switch {
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        section .switch label {
            padding: 10px 20px;
            border-style: solid;
            border-width: 1px;
            border-color: #c6c6c6;
            border-radius: 1rem;
            font-size: 1rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 1rem;
            translate: all .3s ease-in-out;
            cursor: pointer;
        }
        .switch .form-group {
            margin: 0
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
    </style>
@endsection

@section('content')
    <section id="volunteers">
        <h1>طلب التطوع في جمعية رسالة </h1>
        <p>قم بتعبئة بيناتك فى الحقول التالية وسوف يتم الاتصال بك في اقرب وقت</p>
        <a href="/donate"><i class='bx bx-donate-heart'></i> اضغط هنا للتبرع</a>
        <form @submit.prevent>
            <div class="form-group">
                <label for="name">الاسم *</label>
                <input type="text" class="form-control" placeholder="الاسم" v-model="name" id="name">
            </div>       
            <div class="form-group">
                <label for="email">البريد الالكتروني *</label>
                <input type="email" class="form-control" placeholder="البريد الالكتروني" v-model="email" id="email">
            </div>            
            <div class="form-group">
                <label for="phone">رقم الهاتف *</label>
                <input type="text" class="form-control" placeholder="رقم الهاتف" v-model="phone" id="phone">
            </div>            
            <div class="form-group">
                <label for="branch">الفرع *</label>
                <select name="branch" id="branch" v-model="branch_id" class="form-control" v-if="branches && branches.length > 0">
                    <option value="" selected>اختيار الفرع المناسب</option>
                    <option :value="branch.id" v-for="(branch, index) in branches" :key="index">@{{ branch.location }}</option>
                </select>
            </div>
            <div class="form-group" v-if="destinations && destinations.length > 0">
                <label>يرجي اختيار النشاط</label>
                <div class="switch">
                    <div class="form-group" v-for="(destination, index) in destinations" :key="index">
                        <input type="radio" name="type" :id="`destination_${destination.id}`" class="form-control" :value="destination.id" v-model="destination_id">
                        <label :for="`destination_${destination.id}`">
                            <span>@{{ destination.title }}</span>
                        </label>
                    </div>
                </div>          
            </div>      
            <div class="form-group">
                <label for="city">المحافظة *</label>
                <input type="text" class="form-control" placeholder="المحافظة" v-model="city" id="city">
            </div>            
            <div class="form-group">
                <label for="dob">تاريخ الميلاد *</label>
                <input type="date" class="form-control" placeholder="تاريخ الميلاد" v-model="dob" id="dob">
            </div>            
            <div class="form-group">
                <label for="name">العنوان *</label>
                <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="العنوان" v-model="address"></textarea>
            </div>            
            <button @click="send()">ارسال</button>
        </form>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('/libs/axios.js') }}"></script>
    <script src="{{ asset('/libs/vue.js') }}"></script>

    <script>
    const { createApp, ref } = Vue;

    createApp({
    data() {
        return {
            name: '',
            phone: '',
            email: '',
            city: '',
            dob: '',
            address: '',
            destinations: null,
            destination_id: 1,
            branches: null,
            branch_id: null,
        }
    },
    methods: {
        async send() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route("volunteering.send") }}`, {
                    name: this.name,
                    phone: this.phone,
                    email: this.email,
                    city: this.city,
                    dob: this.dob,
                    address: this.address,
                    branch_id: this.branch_id,
                    destination_id: this.destination_id,
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
                        window.location.href = '{{ route("donate.main") }}'
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

                setTimeout(() => {
                $('#errors').fadeOut('slow')
                }, 3500);

                console.error(error);
            }
        },
        async getdestinations() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.get(`{{ route("destinations.getAll") }}`);
                if (response.data.status === true) {
                    $('#errors').fadeOut('slow')
                    this.destinations = response.data.data
                    $('.loader').fadeOut()
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
        async getBranches() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.get(`{{ route("branches.getAll") }}`);
                if (response.data.status === true) {
                    $('#errors').fadeOut('slow')
                    this.branches = response.data.data
                    $('.loader').fadeOut()
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
    },
    created() {
        this.getdestinations()
        this.getBranches()
    },
    }).mount('#volunteers')
    </script>
@endsection