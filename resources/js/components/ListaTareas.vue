<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
          <table class="table table-responsive table-hover ">
              <thead>
                  <tr>
                      <th class="table-active" style="width: 50%; color:white;"> Total de Tareas </th>
                      <th class="table-active" style="width: 40%; color:white;"> Tareas Pendientes </th>
                      <th class="table-active" style="width: 80%; color:white;" > Tareas finalizadas </th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <th style="color:white;"> {{ list.length + tareasCompletas.length  }}</th>
                      <th style="color:white;" > {{ list.length }} </th>
                      <th style="color:white;" > {{  tareasCompletas.length }} </th>
                  </tr>
              </tbody>
          </table>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="todolist not-done">
             <h1>Mis tareas</h1>
             <hr>
                <div class="container">
                    <form action="#">
                        <div class="form-inline">
                            <div class="form-group col-10">
                                <input type="text" class="form-control col-12" id="tarea_desc" placeholder="Agregar nueva Tarea" v-model="tarea.tarea">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success btn-sm btn-block" @click="CrearTarea()">Agregar</button>
                            </div>
                        </div>
                    </form>
                </div>
             <hr>
            </div>
            <div class="card" v-for="(item, index) in list" :key="index">
            <header class="card-header">
                <div class="row">
                    <div class="float-left col-md-6">
                        <p class="card-header-title">
                            Tarea {{ item.id  }}
                        </p>
                    </div>
                 <div class="custom-control custom-checkbox mb-3">
                     <input type="checkbox" v-model="item.realizada"
                     class="custom-control-input" :id="'customCheck_'+item.id" name="example1" v-on:click="completar(item.id)"  >
                    <label class="custom-control-label" :for="'customCheck_'+item.id">Completada</label>
                </div>
            </div>
            </header>

            <div class="card-body not-done">
                <div class="content">
                    <p v-if="item !== editingTask" @dblclick="editTask(item)" v-bind:title="message" >
                          {{ item.tarea }}
                    </p>
                    <input class="form-control" v-if="item === editingTask" @keyup.enter="endEditing(item)" @blur="endEditing(item)" type="text" placeholder="Editar Tarea" v-model="item.tarea" >
            </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-outline-danger btn-lg btn-block" v-on:click.prevent="borratarea(item.id)">
                    Eliminar
                </button>
            </div>
        </div>
    <hr>
</div>
<!--
    ASADAs

    ASDASD

    ASD
 -->
<div class="col-md-6">
    <div class="todolist">
        <h1>Tareas Completadas </h1>
        </div>
            <div class="card" v-for="(item, index) in tareasCompletas" :key="index">
                <header class="card-header">
                    <div class="row">
                        <div class="float-left col-md-6">
                            <p class="card-header-title">
                                Tarea {{ item.id  }}
                            </p>
                        </div>
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" v-model="item.realizada"
                        class="custom-control-input" :id="'customCheck_'+item.id" name="example1" v-on:click="completar(item.id)"  >
                        <label class="custom-control-label" :for="'customCheck_'+item.id">Completada</label>
                    </div>
                </div>
                </header>
                <div class="card-body done">
                    <div class="content">
                         <p  >
                          {{ item.tarea }}
                        </p>
                       <!--  <input class="form-control" v-if="item === editingTask" @keyup.enter="endEditing(item)" @blur="endEditing(item)" type="text" placeholder="Editar Tarea" v-model="item.tarea" > -->

                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-danger btn-lg btn-block" v-on:click.prevent="borratarea(item.id)">
                        Eliminar
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>


</template>

<script>
    export default {
        data () {
            return {
                list : [],
                message:'Doble click para editar',
                tareasCompletas : [],
                tarea : {
                    id:'',
                    tarea:'',
                    realizada:''
                },
                editingTask: {}
            }
        },
        created () {
            this.MilistaTareas();
            this.TareasCompletas_();
        },
        methods : {
            completar (id){
               axios.post('/tareas/completar/' + id).then(result => {
                   this.MilistaTareas();
                   this.TareasCompletas_();
               }).catch(err => {
                   console.log(err);

               })

            },
            editTask (tarea){
                this.editingTask = tarea;



            },endEditing (tarea) {
                this.editingTask = {};
                     axios.post('/tareas/editar_tarea',tarea).then(result =>{
                         console.log('Success');
                     }).catch(err=>{
                         console.log(err);
                     });


            },
            TareasCompletas_ () {
                var url = 'tareas/completas';
                axios.get(url).then(result => {
                    this.tareasCompletas = result.data
                });
            },
            CrearTarea () {


                axios.post('tareas/crear_tarea',this.tarea).then(result => {
                     Vue.swal({
                        type:'success',
                        title:'Tarea creada correctamente',
                        showConfirmButton:false,
                        timer:1500
                    });this.tarea.tarea = '';      this.MilistaTareas();


                }).catch( err => {

                   Vue.swal({
                    type: 'error',
                    title: 'Error al crear la Tarea',
                    text: err.message,
                   });

                });



            },MilistaTareas() {
               var url = 'tareas/activas';
               axios.get(url).then(result => {
                    this.list = result.data
                });
            },
            borratarea(id){
                Vue.swal({
                    title:'¿ Confirmar el borrado de la tarea ?',
                    text: 'Por favor confirme que desea borrar la tarea',
                    type:'warning',
                    showCancelButton:true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText:'Cancelar',
                    confirmButtonText: 'Si, borrar esta tarea!'
                }).then((confirm) => {
                    if(confirm.value) {
                         axios.post('/tareas/borra_tarea/'+id).then(result => {
                              Vue.swal({
                            type:'success',
                            title:'Tarea borrada correctamente',
                            showConfirmButton:false,
                            timer:1500
                        });

                            this.MilistaTareas();
                            this.TareasCompletas_();
                        }).catch((err) => {
                            console.err(err);
                        })
                    }
                })
                /* */
            }
        }
    }
</script>
