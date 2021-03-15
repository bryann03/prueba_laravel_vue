<template>
    <main>
        <h1 class="text-center">Color de imágen</h1>

        <div class="jumbotron">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-primary">Subir imágen</button>
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
export default {
    data(){
        return{
        };
    }
}
</script>

<style lang="scss">
.card-body{
    background-color: aqua;
}
</style>
