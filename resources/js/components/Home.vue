<template>
    <main>
        <h1 class="text-center">Color de imágen</h1>

        <div class="jumbotron">
            <div class="row">
                <div class="col-6">
                    <img v-if="objectImage.image != ''" :src="objectImage.image" alt="image color" class="img-fluid" >
                    <input type="file" class="custom-file-input" id="customFile" @change="onFileChange" >
                    <label class="btn btn-primary" for="customFile">Subir imágen</label>
                    <button v-if="objectImage.image != ''" type="button" class="btn btn-primary" @click="getColor()">Obtener color</button>
                </div>
                <div class="col-6 text-center">
                    <h3>Color predominante</h3>
                    <div class="card" style="height: 18rem;">
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</template>

<script>
import axios from "axios";
export default {
    data(){
        return{
            objectImage:{
                image: ''
            }
        };
    },
    methods:{
        onFileChange(e){
            let files = e.target.files || e.dataTransfer.files;
            if (files.length > 0){
                this.objectImage.image = "http://localhost:80/images/" + files[0]['name'];
                return;
            }
        },
        getColor(){
            axios.post('/image_color', this.objectImage)
                .then( (response) => {
                    console.log(response.data);
                })
                .catch( (error) => {
                    console.log(error);
                })
        }
    }
}
</script>

<style lang="scss">
.card-body{
    background-color: aqua;
}
</style>
