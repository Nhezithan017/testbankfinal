<template>
    <v-container>
       <h3>View Department</h3>
      <dept-nav></dept-nav>
    <router-view></router-view>
    
    </v-container>
</template>

<script>
import VueRouter from 'vue-router';
import Department from './Department/Department.vue';
import AddDept from './Department/AddDept.vue';
import Question from './Question/Question.vue';
import AddQuestion from './Question/AddQuestion.vue';
import EditQuestion from './Question/EditQuestion.vue';
import ImportQuestion from './Question/ImportQuestion.vue';
import DeptNav from './Navigation/DeptNav.vue';
import TrueOrFalse from './TrueOrFalse/TrueOrFalse.vue';
import ImportTrueOrFalse from './TrueOrFalse/ImportTrueOrFalse.vue';
import MatchingType from './MatchingType/MatchingType.vue';
import ImportMatchingType from './MatchingType/ImportMatchingType.vue';
import store from '../store';
export default {
    store,
    props:['courses'],
    components:{
        'dept-nav': DeptNav
    },
    router: new VueRouter({
        mode: 'history',
        base: 'dept-editor',
        routes: [
            {
                path: '/department',
                name: 'department',
                component: Department
            },
            {
                path: '/',
                redirect: { name: 'department' }
            },
            {
                path: '/add-dept',
                name: 'add-dept',
                component: AddDept
            },
            {
                path: '/edit-dept/:id',
                name: 'edit-dept',
                component: AddDept,
                props: true
            },
            {
                path: '*',
                redirect: '/'
            },
              {
                path: '/question/:id',
                name: 'question',
                component: Question,
                props: true
            },
            {
                path: '/add-question/:id',
                name: 'add-question',
                component: AddQuestion,
                props: true
            },
             {
                path: '/edit-question/:id',
                name: 'edit-question',
                component: EditQuestion,
                props: true
            },
              {
                path: '/import-question/:id',
                name: 'import-question',
                component: ImportQuestion,
                props: true
            },
             {
                path: '/trueorfalse/:id',
                name: 'trueorfalse',
                component: TrueOrFalse,
                props:true
            },
            {
                path: '/import-trueorfalse/:id',
                name: 'import-trueorfalse',
                component: ImportTrueOrFalse,
                props: true
            },
            {
                path: '/matching-type/:id',
                name: 'matchingtype',
                component: MatchingType,
                props:true
            },
            {
                path: '/import-matching-type/:id',
                name: 'import-matching-type',
                component: ImportMatchingType,
                props: true
            },
        ]

    })   
}
</script>
