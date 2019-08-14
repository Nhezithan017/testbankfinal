import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        item:[],
        feedback:''
    },
    mutations:{
        SET_MT(state, item){
            state.item = _.cloneDeep(item);
        },
        ADD_MT(state , items){
            state.item.push(items);
        },
        REMOVE_MT(state,index){
            state.item.splice(index,1);
        },
        UPDATE_MT(state,{index,property,value}){
            state.item[index][property] = value;
        },
        SET_FEEDBACK(state, feedback){
            state.feedback = feedback
        }
    },
    actions:{
        showMT({commit,state},id){
            if(id){
                axios.get('/api/matching-type/' + id)
                     .then( res=>{
                       commit('SET_MT', res.data.data)
                 });
            }
        },
        saveMT({commit, state},id){
            axios.post('/api/matching-type/upsert/' + id,{ item: state.item })
            .then((res) => {
                if(res.data.success){
                    commit('SET_FEEDBACK','Changes saved.');
                    setTimeout(()=> commit('SET_FEEDBACK',''),10000);
                    commit('SET_MT', res.data);
                }
            });
        },
        removeMT({commit,state},index){
            let id = state.item[index].id;
            if(id > 0){
            axios.delete('/api/delete-mt/' + id)
                 .then((res) => commit('REMOVE_MT',index));
    
            }
            commit('REMOVE_MT', index);
        }
    }
    
    

});