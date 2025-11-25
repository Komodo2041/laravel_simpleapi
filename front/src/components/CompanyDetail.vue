<template>
   <div id="details">
    <router-link to="/"><span class="btn btn-info">Back</span></router-link><br/>
       <h2> Firma </h2>  
       
       <div class="bg-success text-white comdetail">
            <b>Nazwa </b> : {{details.name}} 
            <b>Adress</b> : {{details.adress}} 
            <b>NIP</b> : {{details.nip}} 
       </div>
       <h3>Pracownicy</h3>
         <table class="table">
            <tr v-for="w in workers" v-bind:key="w.name"> 
              
               <td>{{w.name}}</td>
               <td>{{w.surname}}</td>
               <td>{{w.email}}</td>
               <td>{{w.phone}}</td>
              <td>
                  
 
              </td>
            </tr>
         </table>
   </div>
</template>
<script>

import axios from 'axios';   

export default {  
  name: 'CompanyDetail',
    props: {
        id: {
        type: [Number, String],
        required: true
        }
    }, 
  data() {
    return {
        "workers" : [],
        "details" : []
    }
  },
  created() {
 
    this.getcompany(this.id).then(response => {
        console.log(response.message);
        console.log(response.data);
        this.details = response.data;
        this.workers = response.workers;

     }).catch(error => {
        console.log(error);
     });

 
  },
  methods: {
    getcompany: async function(id) {
        let link = "http://127.0.0.1:8000/api/companydetails/" + id;
        try { 
            const response = await axios.get(link);    
            return response.data;
          } catch (error) {  
            return error.response.data;  
          }
    }
  }
 

}        
</script>
<style>
 .comdetail {font-size:25px; padding:20px 0px;}
</style>