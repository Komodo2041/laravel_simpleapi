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
            </tr>
         </table>
          
        <div class="row">  
          <div class="alert alert-warning" role="alert" v-show="showerror">
             {{error}}
          </div>        
          <form action=""  method="POST" v-on:submit.prevent="addCompany"  >  
            <div class="form-group">
              <h4>Dodaj Nową firumę</h4>
              <label>Nazwa Firmy</label>
              <input type="text" name="name" class="form-control " v-modal="name" /><br/>
              <label>Adress</label>
              <input type="text" name="adress" class="form-control " v-modal="adress" /><br/>
              <label>Miasto</label>
              <input type="text" name="city" class="form-control "  v-modal="city" /><br/>            
              <label>Kod poczotwy</label>
              <input type="text" name="postcode" class="form-control " v-modal="postcode" /><br/>     
              <label>NIP</label>
              <input type="text" name="nip" class="form-control "  v-modal="nip" /><br/>                 
              <input type="submit" class="btn btn-primary" value="Dodaj"   />
          </div>
          </form>
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
    console.log(company);


export default {
 
  data() {
    return {
      company: company,
      name: "",
      city: "",
      postcode: "",
      nip: "",
      adress: "",
      showerror: "",
      error: ""
    }
  }, methods: {
      addFirm : async function(data) {
        let link = "http://127.0.0.1:8000/api/company/add";
 
        try {
            const response = await axios.post(link, data); 
            return response.data;
          } catch (error) {
            console.error('Błąd:', error.response?.data || error.message);
            
          }
     },
     addCompany: function() {
      let res =  this.addFirm([]).then(response => {
 
            console.log(response.errors.length);
            if (response.errors && response.errors.length > 0) {
              this.showerror = true;
              this.error = response.errors.join(", ");
            }   
            this.clearForm(); // opcjonalnie wyczyść pola
         
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
    }    
  }
}
</script>
<style scoped>
 
</style>