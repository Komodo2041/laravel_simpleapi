<template>
   <div class="container">
       <h2>Firmy</h2>
         <table class="table">
            <tr v-for="c in company" v-bind:key="c.name"> 
               <td>{{c.id}}</td>
               <td>{{c.name}}</td>
               <td>{{c.adress}}</td>
               <td>{{c.city}}</td>
               <td>{{c.nip}}</td>
              <td>
                  
                   <router-link :to="{ name: 'CompanyDetail', params: { id: c.id } }">
                      <input type="button" class="btn btn-primary m-1" value="Details">  
                    </router-link>
 
                  <a href="#" class="btn btn-primary m-1" v-on:click="editCompany(c.id)" > Edit </a>
                  <a href="#" class="btn btn-danger m-1" v-on:click="deleteCompany(c.id)" > Delete </a>&nbsp;
              </td>
            </tr>
         </table>
          
        <div class="row">  
          <div class="alert alert-warning col-12" role="alert" v-show="showerror">
             {{error}}
          </div>
          <div class="alert alert-warning col-12" role="alert" v-show="showsuccess">
             {{success}}
          </div>            
          <div class="col-12">      
            <form action=""  method="POST" v-on:submit.prevent="handleForm"  >  
              <div class="form-group">
                <h4>Dodaj Nową firumę</h4>
                <input type="hidden" name="idCompany" v-model="idcompany" />
                <label>Nazwa Firmy</label>
                <input type="text" name="name" class="form-control " v-model="name" /><br/>
                <label>Adress</label>
                <input type="text" name="adress" class="form-control " v-model="adress" /><br/>
                <label>Miasto</label>
                <input type="text" name="city" class="form-control "  v-model="city" /><br/>            
                <label>Kod poczotwy</label>
                <input type="text" name="postcode" class="form-control " v-model="postcode" /><br/>     
                <label>NIP</label>
                <input type="text" name="nip" class="form-control "  v-model="nip" /><br/>    

                <a href="#" class="btn btn-primary m-2"  v-show="idcompany != 0" v-on:click="addnewcomp" >Dodaj nową </a>             
                <input type="submit" class="btn btn-primary" value="Dodaj" v-show="idcompany == 0"  />
                 <input type="submit" class="btn btn-primary" value="Edytuj"  v-show="idcompany != 0" />
            </div>
            </form>
          </div> 
        </div>  

   </div>
</template>
<script>

    import axios from 'axios';
 
    const loadFirms = async () => {
        let link = "http://127.0.0.1:8000/api/company";
        const response = await axios.get(link);
        return response.data.company;
    }
  
    let company = await loadFirms();
   
 
export default {
 

  data() {
    return {
      company: company,
      name: "",
      city: "",
      postcode: "",
      nip: "",
      adress: "",
      showerror: false,
      error: "",
      success: "",
      showsuccess: false,
      idcompany: 0
    };
  }, methods: {
      addFirm : async function(data) {
        let link = "http://127.0.0.1:8000/api/company/add";
        try {
            const response = await axios.post(link, data);
            return response.data;
          } catch (error) {  
            return error.response.data;  
          }
 
     },
      editFirm : async function(data, id) {
        let link = "http://127.0.0.1:8000/api/company/update/" + id;
        try {
            const response = await axios.post(link, data);
            return response.data;
          } catch (error) {  
            return error.response.data;  
          }
 
     },     
     deleteFirm : async function(id) {
        let link = "http://127.0.0.1:8000/api/company/delete/" + id;
        try {
            const response = await axios.delete(link);
            return response.data;
          } catch (error) {  
            return error.response.data;  
          }
     },
     handleForm: function() {

        let datac = {
          name: this.name,
          city: this.city,
          postcode: this.postcode,
          nip: this.nip,
          adress: this.adress
        };
        if (this.idcompany) {
          this.editCompanyForm(datac, this.idcompany);
        } else {
          this.addCompany(datac);
        }

     },     
     addCompany: function(datac) {
  
      this.addFirm(datac).then(response => {
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
              loadFirms().then(response => {
                 this.company = response;
              })
            }
 
        }).catch(error => {
           console.log(error);
        });
  
      return false;
    }, 
    editCompanyForm: function(datac, id) {
 
      this.editFirm(datac, id).then(response => {
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
              loadFirms().then(response => {
                 this.company = response;
              })
            }
 
        }).catch(error => {
           console.log(error);
        });
 
 
      return false;
    },    
    clearForm() {
      this.name = "";
      this.city = "";
      this.postcode = "";
      this.nip = "";
      this.adress = "";
      this.idcompany = 0;
    },
    deleteCompany : function(id) {
          let ok = confirm("Are you sure?");
          if (ok) {
            this.deleteFirm(id).then(response => {
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
                loadFirms().then(response => {
                  this.company = response;
                })
              }

          }).catch(error => {
            console.log(error);
          });
        }
    },
    editCompany : function(id) {
        let selected = "";
        for (let i = 0; i < this.company.length; i++) {
           if (this.company[i]['id'] == id) {
            selected = this.company[i];
            break;
           }
        }
        if (selected) {
          this.name = selected['name'];
          this.city = selected['city'];
          this.postcode = selected['postcode'];
          // this.nip = selected['nip'];
          this.adress = selected['adress'];
          this.idcompany = selected['id'];
        } else {
           // alert("Error");
        }
    }, addnewcomp: function() {
       this.clearForm();
       return false;
    }
  }
}
</script>
<style scoped>
 
</style>