<template>
    <main>
        <h1 class="text-center">Color de imágen</h1>

        <div class="jumbotron">
            <div class="row">
                <div class="col-6">
                    <img v-if="objectImage.image != ''" :src="objectImage.image" alt="image color" class="img-fluid mt-5" >
                    <input type="file" class="custom-file-input" id="customFile" @change="onFileChange" >
                    <label class="btn btn-primary" for="customFile">Subir imágen</label>
                    <button v-if="objectImage.image != ''" type="button" class="btn btn-primary mb-2" @click="getColor()">Obtener color</button>
                </div>
                <div class="col-6 text-center">
                    <h3>Color predominante</h3>
                    <div class="card mb-3" style="height: 18rem;">
                        <div class="card-body" :style="estilo">
                        </div>
                    </div>
                    <div v-if="showLoading">
                        <i class="fas fa-redo fa-spin fa-5x" ></i>
                        <h5 class="mt-3">Obteniendo color...</h5>
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
            },
            estilo:{
                backgroundColor: ""
            },
            showLoading: false
        };
    },
    methods:{
        onFileChange(e){
            let files = e.target.files || e.dataTransfer.files;
            if (files.length > 0){
                this.objectImage.image = "http://localhost:80/prueba_laravel_vue/resources/assets/" + files[0]['name'];
                return;
            }
        },
        getColor(){
            let me = this;
            this.showLoading = true;
            axios.post('/image_color', this.objectImage)
                .then( (response) => {
                    let datos = response.data;
                    me.showLoading = false;
                    // me.estilo.backgroundColor = "rgb(" + datos[0] + "," + datos[1] + "," + datos[2] + ")";
                    me.estilo.backgroundColor = "rgb(" + datos.red + "," + datos.green + "," + datos.blue + ")";
                    // console.log(response.data[0]);
                })
                .catch( (error) => {
                    console.log(error);
                })
        }
    }
}
</script>

<style lang="scss">
.fa-spin {
  -webkit-animation: fa-spin 2s infinite linear;
  animation: fa-spin 2s infinite linear;
}
</style>
