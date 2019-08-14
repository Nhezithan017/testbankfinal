<template>
<v-app>
	<v-container>
		<v-layout>
				<v-flex lg12>
                    <v-alert :value="showFeedback" color="success"  outline>{{ feedback }}</v-alert>
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
  <form @submit.prevent="save()">
		  <div class="form-group row">
		    <div class="col-sm-11">
			<v-text-field label="Question"	v-model="item.question"	></v-text-field>
				</div>
		  </div>
			<div class="form-group row">
					<div class="input-group col-md-5 col-sm-12">
						<span class="col-sm-1">A.</span>
						<span class="input-group-addon col-sm-1"> 
						<input type="radio" value="A" v-model="item.answer">
						</span>
						<input type="text" class="form-control" v-model="item.A">
					</div>
					<div class="input-group col-md-5 col-sm-12">
							<span class="col-sm-1">C.</span>
						<span class="input-group-addon col-sm-1">
						<input type="radio" value="C" v-model="item.answer">
						</span>
						<input type="text" class="form-control" v-model="item.C">
					</div>
				</div>
					 <div class="row mt-2">
					<div class="input-group col-md-5 col-sm-12">
							<span class="col-sm-1">B.</span>
						<span class="input-group-addon col-sm-1">
						<input type="radio"  value="B" v-model="item.answer">
						</span>
						<input type="text" class="form-control" v-model="item.B">
					</div>
					<div class="input-group col-md-5 col-sm-12">
							<span class="col-sm-1">D.</span>
						<span class="input-group-addon col-sm-1">
						<input type="radio"  value="D" v-model="item.answer">
						</span>
						<input type="text" class="form-control" v-model="item.D">
					</div>
				</div>
		  <div class="form-group row mt-5">
		    <div class="col-sm-10">
		      <button  class="btn btn-primary">Save</button>
		    </div>
		  </div>
		  
</form>
</v-container>
</v-app>

</template>

<script>
function newQuestion() {
    return {
                question:'',
                A:'',
                B:'',
                C:'',
                D:'',
				answer:'',
			
            }
}
export default {
    props:['id'],
    data(){
        return{
            item: newQuestion(),
			errors:[],
			showError: false,
			showFeedback:false,
			feedback:''
        }
    },
    methods:{
       save(){
           axios.post('/api/add-question/' + this.id,this.item)
				 .then(res=>{
					 this.feedback =  res.data.msg
					  this.showFeedback = true
					  this.showError = false
				 })
				 .catch(error => {  
					 let message = Object.values(error.response.data.errors);
					 this.errors = [].concat.apply([], message);
					 this.showError = true
				 });
        }
    }
}
</script>
