<template>
  
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card-header">File Upload Component</div>
                    
            <div class="row">
                <div class="col-md-3" v-if="image">
                    <img :src="image" class="img-responsive" height="70" width="90">
                </div>
                <div class="col-md-9">
                    <input name = 'image' type="file" v-on:change="onImageChange" class="form-control">
                </div>
            </div>
           
        </div>
    </div>
  
</template>

<script>
    export default {
        data(){
            return {
                image: ''
            }
        },
        methods: {
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            uploadImage(){
                axios.post('/image/store',{image: this.image}).then(response => { 
                    
                    console.log(response.data.success);
                   }
                );
            }
        }
    }
</script>
