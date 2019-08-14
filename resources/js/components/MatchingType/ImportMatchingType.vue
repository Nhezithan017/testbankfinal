<template>
    <v-app>
        <v-form>
            <v-container align-content-center>
                <v-layout mb-5>
                    <v-flex row wrap>
                        <router-link :to="{name:'matchingtype'}">
                        <v-btn fab dark small color="blue"><v-icon>arrow_left</v-icon></v-btn>
                        </router-link>
                    </v-flex>
                </v-layout>
                <v-layout>
                    <v-flex lg12>
                        <v-alert :value="showError" color="error"  outline>
                            <ul>
                                <p>Please fix the following errors:</p>
                                <li v-for="(error, index) in errors" :key="index">{{ error}}</li>
                            </ul>
                        </v-alert>
                    </v-flex>
                </v-layout>
                <v-flex xs12>
                    <v-alert :value="showFeedback" color="success"  outline>{{ feedback }}</v-alert>
                </v-flex>
                <v-layout row wrap>
                    <v-flex sm3 xs12>
                        	<select v-model="deptShow" @change="changeDept($event)" class="form-control">
					<option value="" selected disabled>-Select Deparment-</option>
                <option v-for="dept in department"  :value="dept" :key="dept.value">{{ dept.name}}</option>
			</select>
                    </v-flex>
                     <v-flex sm3 xs12>
                      	<select v-model="searchItem.course_name" class="form-control">
					<option value="" selected disabled>-Select Course-</option>
                <option v-for="course in deptShow.course" :value="course.name" :key="course.code">{{ course.name}}</option>
			</select>
                    </v-flex>
                     <v-flex sm2 xs12>
                        <v-select
                            :options="trim"
                            v-model="searchItem.trimester"
                            placeholder="Trimester"
                        ></v-select>
                    </v-flex>
                     <v-flex sm2 xs12>
                        <v-select
                           :options="period"
                            v-model="searchItem.period"
                            placeholder="Period"
                        ></v-select>
                    </v-flex>
                    <v-btn  @click.prevent="search()" color="primary"><v-icon>search</v-icon></v-btn>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>   
                            <div class="row" v-for="mt in matchingtype" :key="mt.id">
                                <div class="col-sm-12" v-for="matching in mt.matchingtype" :key="matching.id">
                               </div>
                               <v-container>
                              <v-data-table
                                    :headers="headers"
                                    :items="mt.matchingtype"
                                    class="elevation-1"
                                >
                                    <template slot="items" slot-scope="{ item }">
                                        <td><input type="radio" @change="addImport(item.id)"></td>
                                        <td class="text-xs-left">{{item.premises}}</td>
                                    <td class="text-xs-left">{{item.responses }}</td>
        
                                    </template>
                                </v-data-table>
                                </v-container>         
                                </div>
                         
                    </v-flex>
                  
                </v-layout>
                </v-container>
        </v-form>
    </v-app>
</template>

<script>
import { department,trim,period} from '../departmentInfo';

export default {
    props:['id'],
    data(){
        return{
            searchItem:{
                dept_name:'',
                course_name:'',
                trimester: '',
                period: ''
            },
            matchingtype:[],
            feedback:'',
            showFeedback:false,
            showError:false,
            isChecked:false,
            isSearch:false,
            department,
            period,
            trim,
            deptShow:'',
            errors:[],
            	headers:[
                { text:'Import', value:'import'},
				{ text:'Premises', value:'premises'},
				{ text:'Responses', value:'responses'},
			],
        }
    },
    methods:{
        search()
        {
           axios.get('/api/search?dept_name=' + this.searchItem.dept_name + '&course_name=' + this.searchItem.course_name
                                        + '&trimester=' + this.searchItem.trimester + '&period=' + this.searchItem.period)
                 .then( res=>{  
                        
                        this.showError = false;
                         this.matchingtype = res.data.data;     
                 })
                 .catch(error => {
                     let message = Object.values(error.response.data.errors);
					 this.errors = [].concat.apply([], message);
                     this.showError = true;
                   
                 });

        },
        addImport(mtId){
         
           axios.post('/api/import-matching-type/' + this.id + '/' + mtId)
                 .then(res => {
                        this.feedback = res.data.msg;
                        this.showFeedback = true;
                          setTimeout(()=>  [this.feedback = '',this.showFeedback = false],2000);
                        
                       
                 });
        
        },
        	changeDept(event)
		{
			this.searchItem.dept_name = event.target.options[event.target.options.selectedIndex].text;
		
			
		},
    }
}
</script>
