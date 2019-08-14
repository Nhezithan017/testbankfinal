    <template>
<v-app>
        <v-container grid-list-xs>
            <v-layout mb-5>
		<v-flex row wrap>
			  <v-btn-toggle>
             <router-link :to="{name: 'matchingtype' }">
                <v-btn round color="success" dark><v-icon right small light>add </v-icon>Matching Type</v-btn>
            </router-link>
              <router-link :to="{name: 'import-matching-type' }">
            <v-btn round color="primary" dark><v-icon right small dark>add </v-icon>Import MT</v-btn>
            </router-link>
            </v-btn-toggle>
		</v-flex>
	</v-layout>
            <form @submit.prevent="saveMT()">
                    <v-layout>
				<v-flex lg12>
                    <v-alert :value="showFeedback" color="success"  outline>{{ feedback }}</v-alert>
                </v-flex>
		        </v-layout>
                  <v-layout mb-5 row wrap>
                        <v-btn  color="success" @click="addMT"><v-icon>add</v-icon></v-btn>
                     </v-layout>
                <v-layout row wrap v-for="(mt,index) in item" :key="mt.id">
                    <v-flex xs12>
                        <v-layout row wrap>
                            <v-flex xs6>
                               <v-layout row wrap>
                                   <v-flex xs1>
                                         {{index + 1}}.
                                   </v-flex>
                                   <v-flex xs5>
                                       <v-text-field
                                           label="Premises"
                                        
                                           :rules="nameRules"
                                           :counter="100"
                                           v-model="mt.premises"
                                           :ref="mt.premises"
                                       ></v-text-field>
                                   </v-flex>
                               </v-layout>
                            </v-flex>
                            <v-flex xs6>
                                <v-layout row wrap>
                                   <v-flex xs6>
                                       <v-text-field
                                           label="Responses"
                                         
                                           :rules="nameRules"
                                            :counter="100"
                                            v-model="mt.responses"
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
       <h5>Would you like to delete question <i>{{ mt.premises }}</i> ?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" data-dismiss="modal"  @click.prevent="removeMT(mt.id,index)" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
                                   </v-flex>
                               </v-layout>
                            </v-flex>
                        </v-layout>
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
    export default {
        props:['id'],
        data()
        {
            return {
                item:_.cloneDeep([]),
                nameRules: [
                    v => !!v || 'Fields is required',
                    v => v.length > 10 || 'Fields must be less than 10 characters',
                           ],
                feedback:'',
                showFeedback:false
                  }   
        },
         created(){
        this.showMT();
        },
         computed:{
        checkLength(){
            return this.item.length > 0;
        }
    },
        methods:{
             showMT(){
                if(this.id){
                    axios.get('/api/matching-type/' + this.id)
                         .then( res=>{
                             this.item = res.data.data
                         });
                }
            },
            addMT(){
                this.item.push({
                id:0,
                premises:'',
                responses:''
            });
         this.$nextTick(() => {
             window.scrollTo(0, document.body.scrollHeight);
             this.$refs[''][0].focus();
         });
            },
            saveMT(){
                axios.post('/api/matching-type/upsert/' + this.id,{ item: this.item })
                 .then(res => {
                    this.showFeedback = true;
                   this.feedback = 'Changes saved.';
                   setTimeout(()=>  [this.feedback = '',this.showFeedback = false],2000);
                    this.item = res.data;
                     this.showMT();
                 });
            },
            removeMT(id,index){
              
                    if(id > 0){
                    axios.delete('/api/delete-mt/' + id);
                        this.item.splice(index, 1);
                    }
                    
            }
        }
    }
    </script>
    