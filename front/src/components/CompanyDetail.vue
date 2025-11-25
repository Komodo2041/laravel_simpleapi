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
         <table class="table" v-show="workers">
            <tr v-for="w in workers" v-bind:key="w.name"> 
              
               <td>{{w.name}}</td>
               <td>{{w.surname}}</td>
               <td>{{w.email}}</td>
               <td>{{w.phone}}</td>
              <td>
                  <a href="#" class="btn btn-primary m-1" v-on:click="editw(w.id)" > Edit </a>
                  <a href="#" class="btn btn-danger m-1" v-on:click="deletew(w.id)" > Delete </a>&nbsp;
 
              </td>
            </tr>
         </table>
         <div v-show="workers.length == 0">Brak pracowników</div>
        <div class="row">

          <div class="alert alert-warning col-12" role="alert" v-show="showerror">
             {{error}}
          </div>
          <div class="alert alert-warning col-12" role="alert" v-show="showsuccess">
             {{success}}
          </div>  

          <div class="col-2"></div>  
          <div class="col-8">      
            <form action=""  method="POST" v-on:submit.prevent="handleForm"  >  
              <div class="form-group">
                <h4>Dodaj Nowego pracownika </h4>
                <input type="hidden" name="idWorker" v-model="idworker" />
                <label>Imię</label>
                <input type="text" name="name" class="form-control " v-model="name" /><br/>
                <label>Nazwisko</label>
                <input type="text" name="surname" class="form-control " v-model="surname" /><br/>
                <label>Email</label>
                <input type="text" name="email" class="form-control " v-model="email" /><br/>
                <label>Phone</label>
                <input type="text" name="phone" class="form-control " v-model="phone" /><br/>                    

                <a href="#" class="btn btn-primary m-2"  v-show="idworker != 0" v-on:click="addnewwork" >Dodaj nowego Pracownika </a>             
                <input type="submit" class="btn btn-primary" value="Dodaj" v-show="idworker == 0"  />
                 <input type="submit" class="btn btn-primary" value="Edytuj"  v-show="idworker != 0" />
            </div>
            </form>
          </div> 
        </div> 

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
        "details" : [],
        name: "",
        surname: "",
        phone: "",
        email: "",    
        showerror: false,
        error: "",
        success: "",
        showsuccess: false,
        idworker: 0            
    }
  },
  created() {
 
     this. refreshdata()
 
  },
 
  methods: {
    refreshdata : function() {
        this.getcompany(this.id).then(response => {
 
            this.details = response.data;
            this.workers = response.workers;

        }).catch(error => {
            console.log(error);
        });
    },    
     handleForm: function() {

        let dataw = {
          name: this.name,
          surname: this.surname,
          email: this.email,
          phone: this.phone,
          company_id: this.id
        };
        if (this.idworker) {
          this.editWorkerForm(dataw, this.idworker);
        } else {
          this.addWorkerForm(dataw);
        }

     },     
    getcompany: async function(id) {
        let link = "http://127.0.0.1:8000/api/companydetails/" + id;
        try { 
            const response = await axios.get(link);    
            return response.data;
          } catch (error) {  
            return error.response.data;  
          }
    },
      addWorker : async function(data) {
        let link = "http://127.0.0.1:8000/api/worker/add";
        try {
            const response = await axios.post(link, data);
            return response.data;
          } catch (error) {  
            return error.response.data;  
          }
 
     },
      editWorker : async function(data, id) {
        let link = "http://127.0.0.1:8000/api/worker/update/" + id;
        try {
            const response = await axios.post(link, data);
            return response.data;
          } catch (error) {  
            return error.response.data;  
          }
 
     },  
    clearForm() {
      this.name = "";
      this.surname = "";
      this.email = "";
      this.phone = ""; 
      this.idworker = 0;
    },
    addnewwork: function() {
       this.clearForm();
       return false;
    },
    addWorkerForm: function(dataw) {
  
      this.addWorker(dataw).then(response => {
            const res = response;
 
            if (res.errors && res.errors.length > 0) {
              this.showerror = true;
              this.error =  res.errors.join(", ");
              this.success = false;
            }  else {
              this.showerror = false;
              this.error = "";
              this.clearForm(); 
              this.showsuccess = true;
              this.success = res.message;
              this.refreshdata();
            }
 
        }).catch(error => {
           console.log(error);
        });
  
      return false;
    },         
    editWorkerForm: function(datac, id) {
 
      this.editWorker(datac, id).then(response => {
            const res = response;
 
            if (res.errors && res.errors.length > 0) {
              this.showerror = true;
              this.error =  res.errors.join(", ");
              this.success = false;
            }  else {
              this.showerror = false;
              this.error = "";
              this.clearForm(); 
              this.showsuccess = true;
              this.success = res.message;
              this.refreshdata();
            }
 
        }).catch(error => {
           console.log(error);
        });
 
 
      return false;
    }, 
    editw : function(id) {
        let selected = "";
        for (let i = 0; i < this.workers.length; i++) {
           if (this.workers[i]['id'] == id) {
            selected = this.workers[i];
            break;
           }
        }
        if (selected) {
          this.name = selected['name'];
          this.surname = selected['surname'];
          this.email = selected['email'];
          this.phone = selected['phone'];
          this.idworker = selected['id'];
        } else {
           // alert("Error");
        }
    },
    deletew : function(id) {
          let ok = confirm("Are you sure?");
          if (ok) {
            this.deleteWorker(id).then(response => {
              const res = response;
              if (res.errors && res.errors.length > 0) {
                this.showerror = true;
                this.error =  res.errors.join(", ");
                this.success = false;
              }  else {
                this.showerror = false;
                this.error = ""; 
                this.showsuccess = true;
                this.success = res.message;
                this.refreshdata();
              }

          }).catch(error => {
            console.log(error);
          });
        }
    },
     deleteWorker : async function(id) {
        let link = "http://127.0.0.1:8000/api/worker/delete/" + id;
        try {
            const response = await axios.delete(link);
            return response.data;
          } catch (error) {  
            return error.response.data;  
          }
     },    
  }
 

}        
</script>
<style>
   .comdetail {font-size:25px; padding:20px 0px;}
</style>