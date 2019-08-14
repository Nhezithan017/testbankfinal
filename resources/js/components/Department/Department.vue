<template>
<v-app>
   <v-container>
  <v-data-table
    :headers="headers"
    :items="courses"
    class="elevation-1"
  >
    <template slot="items" slot-scope="{ item }">
      <td>{{ item.dept_name }}</td>
      <td class="text-xs-left">{{ item.sy_start }}</td>
      <td class="text-xs-left">{{item.sy_end }}</td>
      <td class="text-xs-left">{{item.course_name }}</td>
      <td class="text-xs-left">{{item.trimester }}</td>
      <td class="text-xs-left">{{ item.period }}</td>
      <td><v-btn fab dark small color="red" data-toggle="modal" data-target="#exampleModal"> <v-icon dark>delete</v-icon></v-btn>
  
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <h5>Would you like to delete Department <i>{{ item.dept_name }} </i> ?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" data-dismiss="modal"  @click.prevent="removeDept(item)" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
    <router-link :to="{name: 'edit-dept',params:{ id: item.id }}">
    <v-btn fab dark small color="cyan">
      <v-icon dark>edit</v-icon>
    </v-btn>
    </router-link>
    <v-menu
      bottom
      origin="center center"
      transition="scale-transition"
    >
      <template v-slot:activator="{ on }">
         <v-btn fab dark color="teal" small v-on="on">
      <v-icon dark>list</v-icon>
        </v-btn>
      </template>
    
            <v-list>
                <v-list-tile >
                   <router-link :to="{ name: 'question', params:{ id: item.id }}">  
                <v-list-tile-title>Multiple Choice</v-list-tile-title>
                    </router-link>
                </v-list-tile>
                        <v-list-tile >
                   <router-link :to="{ name: 'trueorfalse', params:{ id: item.id }}">  
                <v-list-tile-title>True Or False</v-list-tile-title>
                    </router-link>
                </v-list-tile>
                 <v-list-tile >
                   <router-link :to="{ name: 'matchingtype', params:{ id: item.id }}">  
                <v-list-tile-title>Matching Type</v-list-tile-title>
                    </router-link>
                </v-list-tile>
            </v-list>

    </v-menu>
    </td>
    </template>
  </v-data-table>
  </v-container>
</v-app>
</template>

<script>


export default {
    data(){
        return{
            courses:[],
            feedback:'',
            dialog:false,
             headers: [
          {
            text: 'Department',
            sortable: true,
            value:'department'
          },
          { text: 'Sy - Start', value: 'calories' },
          { text: 'Sy - End', value: 'fat' },
          { text: 'Course', value: 'carbs' },
          { text: 'Trimester', value: 'protein' },
          { text: 'Period', value: 'iron' }
        ],
        }
    },
    created()
    {
      this.getDept();
    },
    methods:{
       async removeDept(item){
            
            let index = this.courses.indexOf(item);
            let id = this.courses[index].id;
            if(id > 0){
             await  axios.delete('/api/department/delete/' + id);
                this.courses.splice(index, 1);
            }
            this.dialog = false;
        },
       async getDept(){
         await axios.get('/api/department', this.courses)
               .then(res=> {
                    this.courses = res.data.data
               });
        },
        download(courseId){
          axios.get('/api/download/' + courseId);
        }
      
    }
}
</script>

