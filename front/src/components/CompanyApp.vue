<template>
   <div>
       <h2> {{name}} </h2>
         <table class="table">
            <tr v-for="c in company" v-bind:key="c.name"> 
               <td>{{c.name}}</td>
               <td>{{c.adress}}</td>
               <td>{{c.city}}</td>
               <td>{{c.nip}}</td>
            </tr>
         </table>
          
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
      name: "Firmy",
      company: company
    }
  }
}
</script>
<style scoped>
</style>