<template>
    <div class="container">
        <div   class="custom-modal">
            <div class="images" >
                <div class="image-item" v-for="image in productImages" >
                    <input label="test" type="radio" name="main-image" v-on:change="handleChangeMainImage(image.id,$event)" :checked="image.main" />
                    <img :src="image.url" alt="image" class="image">

                    <button :disabled="disable" v-on:click="deleteImage(image.id,$event)" class="btn btn-sm btn-danger">
                        حذف
                    </button>
                </div>
            </div>
            <div class="input-group input-group-sm">
                <input v-on:change="changeImage" name="image" type="file" class="form-control ">
                <button :disabled="disable" v-on:click="uploadImage" class="btn btn-warning btn-sm">آپلود</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name : "ImageUploader",
        props:['images','product_id'],
        data(){
            return{
                productImages : JSON.parse(this.images),
                formData: '' ,
                disable:false
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.formData = new FormData();
        },
        methods:{
            deleteImage(image_id,event){
                event.preventDefault();
                console.log(image_id);
                this.disable=true;
                const URL = `/admin/products/image-destroy/${image_id}`;
                axios.delete(
                    URL,
                    this.formData,
                    {'content-type': 'multipart/form-data'}
                ).then(
                    response => {
                        if(response.status === 200){
                            this.productImages = this.productImages.filter(image=>image.id !== image_id)
                        }
                        console.log('image upload response > ', response);
                        this.disable=false;
                    }
                ).catch(err=>{
                    console.error('image upload err > ', err);
                    this.disable=false;
                })

            },
            changeImage(event){
                this.formData.append('product_image',event.target.files[0]);
            },
            uploadImage(event) {
                event.preventDefault();
                this.disable=true;
                const URL = `/admin/products/${this.product_id}/image-upload`;

                axios.post(
                    URL,
                    this.formData,
                    {'content-type': 'multipart/form-data'}
                ).then(
                    response => {
                        if(response.status === 200){
                            let image = response.data;
                            this.productImages.push(image)

                        }
                        console.log('image upload response > ', response);
                        this.disable=false;
                    }
                ).catch(err=>{
                    console.error('image upload err > ', err);
                    this.disable=false;
                })
            },
            handleChangeMainImage(image_id,event){
                // console.log(image_id , event.target.value === 'on');
                event.preventDefault();
                // console.log(image_id);
                this.disable=true;
                const URL = `/admin/products/${this.product_id}/image-main/${image_id}`;
                axios.put(
                    URL
                ).then(
                    response => {
                        if(response.status === 200){
                            this.productImages = this.productImages.map(image=> {
                                if (image.id === image_id){
                                    return {...image,main:true}
                                }else {
                                    return  {...image,main:false}
                                }
                            })
                        }
                        this.disable=false;
                    }
                ).catch(err=>{
                    console.error(err);
                    this.disable=false;
                })
            }
        }
    }
</script>
<style>
    .custom-modal{
        flex: 1;
        display: flex;
        flex-direction: column;
        width: 100vm;
        position: relative;
        z-index: 2000;
        background: rgba(10, 18, 28, 0.76);
        padding: 20px;
    }

    .image-item{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        min-height: 100px;
        border: 1px solid #737373;
        padding: 5px 15px;
        margin-bottom: 25px;
        border-radius: 25px;
    }
    .image{
        max-width: 200px;
        align-self: stretch;
        background-color: white;
        margin-right: 25px;
    }
</style>
