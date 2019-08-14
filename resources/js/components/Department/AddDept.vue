<template>
<v-app>
<v-form @submit.prevent="save()">
<v-container>
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
	<v-layout row wrap>
		 <v-flex  xs12>
		<select v-model="deptShow"  @change="changeDept($event)" class="form-control">
					<option value="" selected disabled>-Select Deparment-</option>
				<option v-for="dept in department"  :value="dept" :key="dept.value">{{ dept.name}}</option>
			</select>
	    </v-flex>
			</v-layout>
		<v-layout row wrap>	
		<v-flex xs12>
		<select v-if="deptShow" v-model="item.course_code" @change="changeCourse($event)" class="form-control">
				<option value="" selected disabled>-Select Course-</option>
				<option v-for="course in deptShow.course" :value="course.code" :key="course.code">{{ course.name}}</option>
			</select>
		</v-flex>
	</v-layout>
	<v-layout>
			<v-flex xs6>
			<date-picker type="year" placeholder="sy-start" width="100%"  v-model="item.sy_start" valueType="format" lang="en" format="YYYY"></date-picker>	
		
		</v-flex>
		<v-flex xs6>
			<date-picker type="year" placeholder="sy-end" width="100%" v-model="item.sy_end" valueType="format" lang="en" format="YYYY"></date-picker>
		</v-flex>
	</v-layout>
	
	<v-layout row wrap>
		<v-flex  xs12>
			<v-select v-model="item.trimester" placeholder="Trimester" :options="trim"></v-select>
		</v-flex>
		<v-flex  xs12>
		<v-select v-model="item.period"  placeholder="Period"   :options="period"></v-select>
		</v-flex>
	</v-layout>
	<v-layout>
		<v-flex>
			<v-btn  type="submit" color="info">Save</v-btn>
		</v-flex>
	</v-layout>
</v-container>
</v-form>
</v-app>
</template>
<script>

import datePicker from 'vue2-datepicker';
import { department,trim,period} from '../departmentInfo';




function newDept()
{
	return {
				dept_name: '',
				sy_start:'',
				sy_end: '',
				course_name: '',
				course_code:'',
				trimester: '',
				period:'',
			};
}
export default {
	name: 'add-dept',
	props:['id'],
    data(){
        return{
			item: newDept(),
			department,
			trim,
			period,
			errors:[],
			showError: false,
			feedback:'',
			deptShow:'',
			courseArray:[]
		
        }
    },
    components:{
        datePicker
	},
	  created(){
		this.showDept()
	},
	beforeRouteLeave(to, from, next){
		this.item = newDept();

		next();
	},
	methods:{
	 save(){
			let url = '/api/department/add-dept';

			if(this.id)
			{
				url = '/api/department/' + this.id;
			}
			 axios.post(url,this.item)
				 .then(res=>{
					this.$router.push('/dept-editor/department');
					
				 })
				 .catch(error => {
					 let message = Object.values(error.response.data.errors);
					 this.errors = [].concat.apply([], message);
					 this.showError = true
					
					 setTimeOut(this.showError,200);
				 });
		},
		async showDept(){
			if(this.id){
			await axios.get('/api/department/' + this.id)
				 .then(res => this.item = res.data);
		}
		},
		changeDept(event)
		{
			this.item.dept_name = event.target.options[event.target.options.selectedIndex].text;
		
			
		},
		changeCourse(event)
		{
			this.item.course_name = event.target.options[event.target.options.selectedIndex].text;
			
		},
		changeSy(event)
		{
			console.log(event.target.value);
		}
	}
	}

</script>
