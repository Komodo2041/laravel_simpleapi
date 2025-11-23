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
                  <a href="#" v-on:click="deleteCompany(c.id)" > x </a>
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
            <form action=""  method="POST" v-on:submit.prevent="addCompany"  >  
              <div class="form-group">
                <h4>Dodaj Nową firumę</h4>
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
                <input type="submit" class="btn btn-primary" value="Dodaj"   />
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
      showsuccess: false
    }
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
     deleteFirm : async function(id) {
        let link = "http://127.0.0.1:8000/api/company/delete/" + id;
        try {
            const response = await axios.delete(link);
            return response.data;
          } catch (error) {  
            return error.response.data;  
          }
     },     
     addCompany: function() {
 
      let datac = {
        name: this.name,
        city: this.city,
        postcode: this.postcode,
        nip: this.nip,
        adress: this.adress
      };
   
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
    clearForm() {
      this.name = "";
      this.city = "";
      this.postcode = "";
      this.nip = "";
      this.adress = "";
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
    }
  }
}
</script>
<style scoped>
 
</style>