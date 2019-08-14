<template>
<v-app>
    <v-container>
        	<v-layout mb-5>
		<v-flex row wrap>
			  <v-btn-toggle>
             <router-link :to="{name: 'trueorfalse' }">
                <v-btn round color="success" dark><v-icon right small light>add </v-icon>True or False </v-btn>
            </router-link>
              <router-link :to="{name: 'import-trueorfalse' }">
            <v-btn round color="primary" dark><v-icon right small dark>add </v-icon>Import TF</v-btn>
            </router-link>
            </v-btn-toggle>
		</v-flex>
	</v-layout>
        <form @submit.prevent="saveTF()">
            <v-layout>
				<v-flex lg12>
                    <v-alert :value="showFeedback" color="success"  outline>{{ feedback }}</v-alert>
                </v-flex>
		</v-layout>
        <v-layout mb-5 row wrap>
            <v-btn  color="success" @click="addTF" ><v-icon>add</v-icon></v-btn>
        </v-layout>
        <v-layout row wrap v-for="(it,index) in item" :key="it.id">
            <v-flex xs2>
               <div class="form-check form-check-inline row">
                    {{index + 1}}.
                   <label class="form-check-label col-sm">  </label>
                       <input class="form-check-input" type="radio" v-model="it.isCorrect"   value="1" :checked="it.isCorrect == 1"> True
                 
                      <label class="form-check-label col-sm">   </label>
                    <input class="form-check-input" type="radio"  v-model="it.isCorrect" value="0" :checked="it.isCorrect == 0"> False
               
               </div>
            </v-flex>
            
            <v-flex xs8>
                  <v-text-field
                      name="name"
                      label="Question"
                      id="id"
                      v-model="it.ques_name"
                      :ref="it.ques_name"
                      :rules="nameRules"
                      :counter="255"
                       
                    
                  ></v-text-field>
            </v-flex>
            <v-flex xs2>
                <v-btn fab dark small color="red" data-toggle="modal" data-target="#exampleModal"> <v-icon dark>delete</v-icon></v-btn>
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
       <h5>Would you like to delete question <i>{{ it.ques_name }} </i> ?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" data-dismiss="modal"  @click.prevent="removeTF(it.id,index)" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
            </v-flex>
        </v-layout>
        <v-layout row wrap>
            <v-flex xs1>
                <v-btn color="info" type="submit" v-show="checkLength"><v-icon>save</v-icon></v-btn>
            </v-flex>
        </v-layout>
        </form>
    </v-container>
</v-app>
</template>

<script>
import { setTimeout } from 'timers';
export default {
    props:['id'],
    data(){
        return{
           item:_.cloneDeep([]),
           showFeedback:false,
           feedback:'',
           showFeedback:false,
            nameRules: [
        v => !!v || 'Question is required',
        v => v.length > 10 || 'Question must be less than 10 characters',
      ]
        }
    },
    computed:{
        checkLength(){
            return this.item.length > 0;
        },
        ifEmpty(){
           return this.item.ques_name >0;
        }
    },
    created(){
        this.showTF();
    },
    methods:{
        addTF(){
            this.item.push({
                id:0,
                ques_name:'',
                isCorrect:false
            });
         this.$nextTick(() => {
             window.scrollTo(0, document.body.scrollHeight);
             this.$refs[''][0].focus();
         });
        
        },
        showTF()
        {
               if(this.id){
                axios.get('/api/trueorfalse/' + this.id)
                 .then(res => {
                  this.item = res.data.data;
                 });
             }
           
        },
        saveTF(){
   
            axios.post('/api/trueorfalse/upsert/' + this.id,{ item: this.item })
                 .then(res => {
                     this.showFeedback=true;
                   this.feedback = 'Changes saved.';
                 setTimeout(()=>  [this.feedback = '',this.showFeedback = false],2000);
                    this.item = res.data;
                     this.showTF();
                 });
        },
        removeTF(id,index){

          
            if(id > 0){
               axios.delete('/api/delete-tf/' + id);
                this.item.splice(index, 1);
            }
               
        }
    }
}
</script>
