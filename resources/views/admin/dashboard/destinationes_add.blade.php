@extends('admin.layouts.admin-layout')
@section('title', 'اضافة فرع')
@section('destination_preview_active', 'active')

@section('content')
<h3 class="mb-5">
    اضاقة جهة تطوع
</h3>
<main  id="destinations_add">
    <div class="card w-100">
        <div class="card-body p-4">
            <form @submit.prevent>
                <div class="form-group mb-3">
                    <label for="title">العنوان *</label>
                    <input type="text" name="title" id="title" v-model="title" class="form-control mt-2" placeholder="العنوان">
                </div>
                <div class="d-flex gap-2">
                    <div class="form-group w-50">
                        <textarea name="description" id="description" v-model="description"  class="form-control h-100" placeholder="الوصف">
                        </textarea>
                    </div>
                    <div class="w-50">
                        <div @click="this.showImages = true; this.current_article_id = null" class="w-100 h-100 p-3 d-flex justify-content-center align-items-center form-control" style="max-height: 170px;">
                            <img :src="preview_img ? preview_img : '{{ asset('dashboard/images/add_image.svg') }}'" id="preview" alt="img logo" style="width: 100%; max-width: 100%;object-fit: contain;height: 100%;">                                                
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-3" @click="add()">اضافة</button>
            </form>

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
                        <button class="btn btn-light"  @click="this.showImages = false; this.search = null;">Cancel</button>
                        <button class="btn btn-success"  @click="previewThumbnail()">Choose</button>
                    </div>
                </div>
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
            title: null,
            description: null,
            preview_img: null,
            showImages: false,
            showUploadPopUp: false,
            image: null,
            choosed_img: null,
            current_article_id: null,
            image_Id: null,
            choosedImgId: null,
        }
    },
    methods: {
        async add() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route("destinations.put") }}`, {
                    title: this.title,
                    description: this.description,
                    image_id: this.image_Id
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
                        window.location.href = '{{ route("destinations.prev") }}'
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
        previewThumbnail () {
            this.image_Id = this.choosedImgId;
            this.preview_img = this.choosed_img;
            this.showImages = false;
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
                    "{{ asset('/dashboard/images/add_image.svg') }}"
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
                $("#errors").fadeIn("slow");
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
            this.choosed_img = '{{ asset("/dashboard/images/uploads") }}/' + imagePath;
        },
    },
    created() {
        $('.loader').fadeOut()
        this.getImages()
    },
    mounted() {
        $(document).on('click', '.imgs .img', function () {
            $(this).css('border', '1px solid #13DEB9')
            $(this).siblings().css('border', 'none')
        })
    },
}).mount('#destinations_add')
</script>
@endsection
