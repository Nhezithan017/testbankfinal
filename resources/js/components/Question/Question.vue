<template>
<v-form>
<v-app>
<v-container>
	<v-layout mb-5>
		<v-flex row wrap>
			  <v-btn-toggle>
             <router-link :to="{name: 'add-question' }">
                <v-btn round color="success" dark><v-icon right small light>add </v-icon>Add Question</v-btn>
            </router-link>
              <router-link :to="{name: 'import-question' }">
            <v-btn round color="primary" dark><v-icon right small dark>add </v-icon>Import Question</v-btn>
            </router-link>
            </v-btn-toggle>
		</v-flex>
	</v-layout>
<v-data-table
    :headers="headers"
    :items="questions"
    class="elevation-1"
  >
    <template slot="items" slot-scope="{ item }">
	  <td class="text-xs-left">{{item.answer }}</td>
      <td class="text-xs-left">{{ item.question }}</td>
      <td class="text-xs-left">{{item.A }}</td>
      <td class="text-xs-left">{{item.B }}</td>
      <td class="text-xs-left">{{ item.C }}</td>
	    <td class="text-xs-left">{{ item.D }}</td>
      <td><v-btn fab dark small color="red" data-toggle="modal" data-target="#exampleModal"> <v-icon dark>remove</v-icon></v-btn>
     
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
       <h5>Would you like to delete Department <i>{{ item.question }} </i> ?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" data-dismiss="modal"  @click.prevent="removeQuestion(item)" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
    <router-link :to="{name: 'edit-question',params:{ id: item.id }}">
    <v-btn fab dark small color="cyan">
      <v-icon dark>edit</v-icon>
    </v-btn>
    </router-link>
    </td>
    </template>
  </v-data-table>

</v-container>
</v-app>
</v-form>
</template> 
<script>
export default {
    props:['id'],
    data(){
        return {
			questions:[],
			headers:[
				{ text:'Answer', value:'answer'},
				{ text:'Question', value:'question'},
				{ text:'A', value:'A'},
				{ text:'B', value:'B'},
				{ text:'C', value:'C'},
				{ text:'D', value:'D'},
			]
        }
    
	},
	mounted(){
		this.questions.answer ? true : false
	},
    created(){
          this.showQue();
    },
    methods:{
        removeQuestion(item){
			let index = this.questions.indexOf(item);
             let id = this.questions[index].id;
            if(id > 0){
               axios.delete('/api/delete-question/' + id);
                this.questions.splice(index, 1);
            }
              
        },
        showQue(){
             if(this.id){
                axios.get('/api/question/' + this.id)
                 .then(res => {
                  this.questions = res.data.data;
                 });
             }
           
        }
    }
    }

</script>
