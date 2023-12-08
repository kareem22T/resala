@extends('admin.layouts.admin-layout')
@section('title', "تعديل الصفحة الرئيسية")
@section('home_active', 'active')
@section('styles')
    <style>
        .images_wrapper {
            flex-wrap: wrap
        }
        .images_wrapper .img{
            width: 150px;
            padding: 10px;
            border-radius: 20px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .images_wrapper_events .img{
            width: 150px;
            padding: 10px;
            border-radius: 20px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .images_wrapper .img img{
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .images_wrapper .img .after{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            background: #0000008c;
            transition: all .2s ease-in;
            cursor: pointer;
            opacity: 0;
        }
        .images_wrapper .img:hover .after{
            opacity: 1;
        }
    </style>
@endsection
@section('content')
<div id="home_content">
    <h1 class="mb-5">
        تعديل الصفحة الرئيسية
    </h1>
    <h3 class="mb-4">اختار صور اسلايدر الصفحة الرئيسية</h3>

    <div class="d-flex gap-2">
        <div class="w-100">
            <div class="d-flex gap-2 images_wrapper mt-3 align-items-end">
                <div class="img card mb-0" dir="ltr" v-if="sliderSlides && sliderSlides.length > 0" v-for="(img, index) in sliderSlides" :key="img.id" v-for="image in sliderSlides">
                    <img :src="img.slide_path" alt="image">
                    <div class="after">
                        <div class="d-flex gap-2">
                            <button class="btn btn-secondary" @click="changeImgSortInSlider(img.id, 'next')"><i class="ti ti-circle-caret-left"></i></button>
                            <button class="btn btn-secondary" @click="changeImgSortInSlider(img.id, 'prev')"><i class="ti ti-circle-caret-right"></i></button>
                        </div>
                        <button class="btn btn-danger" @click="deleteImgFromSlider(img.id)"><i class="ti ti-trash"></i></button>
                    </div>
                </div>
                <button class="btn btn-success mb-2" @click="this.isSlider = true;isEvents = false;showImages = true;">اضافة صورة</button>
            </div>
        </div>
    </div>
<br>
    <h3 class="mb-4">اختار صور من اخر الفاعليات</h3>

    <div class="d-flex gap-2">
        <div class="w-100">
            <div class="d-flex gap-2 images_wrapper images_wrapper_events mt-3 align-items-end">
                <div class="img card mb-0" dir="ltr" v-if="eventsImgs && eventsImgs.length > 0" v-for="(img, index) in eventsImgs" :key="img.id" v-for="image in sliderSlides">
                    <img :src="img.slide_path" alt="image">
                    <div class="after">
                        <div class="d-flex gap-2">
                            <button class="btn btn-secondary" @click="changeImgSortInEvents(img.id, 'next')"><i class="ti ti-circle-caret-left"></i></button>
                            <button class="btn btn-secondary" @click="changeImgSortInEvents(img.id, 'prev')"><i class="ti ti-circle-caret-right"></i></button>
                        </div>
                        <button class="btn btn-danger" @click="deleteImgFromEvents(img.id)"><i class="ti ti-trash"></i></button>
                    </div>
                </div>
                <button class="btn btn-success mb-2" @click="this.isSlider = false;isEvents = true;showImages = true;">اضافة صورة</button>
            </div>
        </div>
    </div>

    <div class="hide-content" v-if="showImages"></div>
    <div class="pop-up show-images-pop-up card" v-if="showImages" style="min-width: 90vw;height: 90vh;padding: 20px;display: flex;flex-direction: column;justify-content: space-between;gap: 1rem;">
        <input type="text" name="search" id="search" class="form-control w-25 mb-2" placeholder="Search" v-model="search" @input="getSearchImages(this.search)">
        <div class="imgs p-2 gap-3" v-if="images && images.length" style="display: flex;grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));flex-wrap: wrap;height: 100%;overflow: auto;">
            <div class="img" @click="this.choosed_img = '{{ asset("/dashboard/images/uploads") }}/' + img.path; this.choosedImgId = img.id" v-for="(img, index) in images" :key="img.id" style="width: 260px;height: 230px;overflow: hidden;padding: 10px;border-radius: 1rem;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <img :src="'{{ asset("/dashboard/images/uploads") }}/' + img.path" id="preview" alt="img logo" style="width: 100%;height: 100%;object-fit: contain;">
            </div>
        </div>
        <div class="pagination w-100 d-flex gap-2 justify-content-center mt-3" v-if="last_page > 1">
            <div v-for="page_num in last_page" :key="page_num" >
                <label :for="`page_num_${page_num}`" class="btn btn-primary" :class="page_num == page ? 'active' : ''">@{{ page_num }}</label>
                <input type="radio" class="d-none" name="page_num" :id="`page_num_${page_num}`" v-model="page" :value="page_num" @change="!search ? getImages() : getSearchImages(this.search)">
            </div>
        </div>
        <h1 v-if="images && !images.length && !search">There is not any image yet! (upload now)</h1>
        <div class="foot" style="display: flex;width: 100%;justify-content: space-between;gap: 1rem;">
            <button class="btn btn-primary" @click="this.showUploadPopUp = true">Upload Image</button>
            <div class="hide-content" v-if="showUploadPopUp"></div>
            <div class="pop-up card p-3" v-if="showUploadPopUp">
                <label for="image" class="mb-2">Choose Image File</label>
                <input type="file" name="image" id="image" class="form-control mb-4" @change="imageChanges">
                <div class="d-flex gap-2 w-100 justify-content-center">
                    <button class="btn btn-light"  @click="this.showUploadPopUp = false">Cancel</button>
                    <button class="btn btn-secondary" @click="uploadImage(image)">
                        Add Image
                    </button>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-light"  @click="this.showImages = false; this.search = null;this.forSlider = false">Cancel</button>
                <button class="btn btn-success"  @click="addImageToSection()">Choose</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
const { createApp, ref } = Vue;

createApp({
  data() {
    return {
      thumbnail: null,
      title: '',
      content: '',
      images: null,
      showImages: false,
      showUploadPopUp: false,
      image: null,
      choosed_img: null,
      current_article_id: null,
      search_tags: null,
      preview_img: null,
      search: null,
      page: 1,
      total: 0,
      last_page: 0,
      forSlider: false,
      slider_imgs: [],
      showSliderPopUp: false,
      code: '',
      showCodePopUp: false,
      album_imgs: [],
      forAlbum: false,
      type: 'post',
      publish_date: new Date().toISOString().split('T')[0],
      isSlider: false,
      isEvents: false,
      sliderSlides: null,
      eventsImgs: null,
    }
  },
  methods: {
    async getSlidesImages() {
        try {
            const response = await axios.post(`{{ route('admin_home.get.slider') }}`
            );
            if (response.data.status === true) {
                $('.loader').fadeOut()
                this.sliderSlides = response.data.data
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
    async getLatestEventsImages() {
        try {
            const response = await axios.post(`{{ route('admin_home.get.events') }}`
            );
            if (response.data.status === true) {
                $('.loader').fadeOut()
                this.eventsImgs = response.data.data
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
    async addImgToSlider(path) {
      $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`{{ route('home.slider.add') }}`, {
                slide_path: path,
            },
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            );
            if (response.data.status === true) {

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
    async addImgToEvents(path) {
      $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`{{ route('home.events.add') }}`, {
                slide_path: path,
            },
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            );
            if (response.data.status === true) {

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
    async deleteImgFromSlider(id) {
      $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`{{ route('home.slider.delete') }}`, {
                slide_id: id,
            },
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            );
            if (response.data.status === true) {
                this.getSlidesImages()
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
    async deleteImgFromEvents(id) {
      $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`{{ route('home.events.delete') }}`, {
                slide_id: id,
            },
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            );
            if (response.data.status === true) {
                this.getLatestEventsImages()
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
    async changeImgSortInSlider(id, dir) {
      $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`{{ route('home.slider.change.sort') }}`, {
                slide_id: id,
                dir: dir,
            },
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            );
            if (response.data.status === true) {
                this.getSlidesImages()
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
    async changeImgSortInEvents(id, dir) {
      $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`{{ route('home.events.change.sort') }}`, {
                slide_id: id,
                dir: dir,
            },
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            );
            if (response.data.status === true) {
                this.getLatestEventsImages()
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
    async getImages() {
        $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.get(`{{ route('lib.getImages') }}?page=${this.page}`
            );
            if (response.data.status === true) {
                $('.loader').fadeOut()
                this.images = response.data.data.data
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
    async getSearchImages(search_words) {
        try {
            const response = await axios.post(`{{ route('lib.images.search')}}?page=${this.page}`, {
                search_words: search_words,
            },
            );
            if (response.data.status === true) {
                this.images = response.data.data.data
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
    async uploadImage(image) {
        $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`{{ route('lib.image.uploade') }}`, {
                img: image,
            },
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }

            );
            if (response.data.status === true) {
                document.getElementById('errors').innerHTML = ''
                let error = document.createElement('div')
                error.classList = 'success'
                error.innerHTML = response.data.message
                document.getElementById('errors').append(error)
                $('#errors').fadeIn('slow')
                $('.loader').fadeOut()
                this.showUploadPopUp = false;
                this.showImages = false;
                this.getImages()
                setTimeout(() => {
                    this.showImages = true;
                    $('#errors').fadeOut('slow')
                }, 3000);
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
    photoChanges(event) {
        this.thumbnail = event.target.files[0];
        var file = event.target.files[0];
        var fileType = file.type;
        var validImageTypes = ["image/gif", "image/jpeg", "image/jpg", "image/png"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            document.getElementById("errors").innerHTML = "";
            let error = document.createElement("div");
            error.classList = "error";
            error.innerHTML =
                "Invalid file type. Please choose a GIF, JPEG, or PNG image.";
            document.getElementById("errors").append(error);
            $("#errors").fadeIn("slow");
            setTimeout(() => {
                $("#errors").fadeOut("slow");
            }, 2000);

            $(this).val(null);
            $("#preview").attr(
                "src",
                "/Moheb/dashboard/images/add_image.svg"
            );
            $(".photo_group i").removeClass("fa-edit").addClass("fa-plus");
        } else {
            // display image preview
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#preview").attr("src", e.target.result);
                $(".photo_group  i")
                    .removeClass("fa-plus")
                    .addClass("fa-edit");
                $(".photo_group label >i").fadeOut("fast");
            };
            reader.readAsDataURL(file);
        }
    },
    imageChanges(event) {
        this.image = event.target.files[0];
                // check if file is valid image
        var file = event.target.files[0];
        var fileType = file.type;
        var validImageTypes = ["image/gif", "image/jpeg", "image/jpg", "image/png"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            document.getElementById("errors").innerHTML = "";
            let error = document.createElement("div");
            error.classList = "error";
            error.innerHTML =
                "Invalid file type. Please choose a GIF, JPEG, or PNG image.";
            document.getElementById("errors").append(error);
            setTimeout(() => {
                $("#errors").fadeOut("slow");
            }, 2000);

            $(this).val(null);
        } else {
            // display image preview
            var reader = new FileReader();
            reader.onload = function (e) {
            };
            reader.readAsDataURL(file);
        }

    },
    chooseImage(imagePath) {
        this.choosed_img = '/dashboard/images/uploads/' + imagePath;
    },
    setValuesToNull () {
        this.chooseImage = null
        this.current_article_id = null
        this.showImages = null
        this.isSlider = false
        this.isEvents = false
    },
    addImageToSection () {
        if (this.isSlider) {
            this.addImgToSlider(this.choosed_img)
            this.getSlidesImages()
            this.setValuesToNull()
        }
        if (this.isEvents) {
            this.addImgToEvents(this.choosed_img)
            this.getLatestEventsImages()
            this.setValuesToNull()
        }
    },
  },
  created() {
    this.getImages()
    this.getSlidesImages()
    this.getLatestEventsImages()
  },
  mounted() {
    $(document).on('click', '.imgs .img', function () {
        $(this).css('border', '1px solid #13DEB9')
        $(this).siblings().css('border', 'none')
    })
  },
}).mount('#home_content')
</script>
@endsection