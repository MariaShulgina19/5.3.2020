<template>
  <div class="allships">
    <h5>{{ msg6 }}, {{currentDate}}</h5>
    <!-- <h5>{{ allShipsFirstVessel}}, {{allShipsMMSI}}</h5> -->
    <h5>{{ allShips2 }}</h5> 

    <li v-for= "item in allShips" v-bind:key = "item.id"> {{ item.vesselName }}, {{item.mmsi }}</li>

    <!-- <h3>{{ locbyMMSI }}</h3>   gives coordinnate of one particular ship -->

  <!-- <h3>{{ newlist}}</h3> -->
  <li v-for= "item in newlist" v-bind:key = "item.id"> {{ item }}</li>
  allShips3
  <h3>{{ allShips3 }}</h3>   
     <!-- <h5>{{ allShips2 }}</h5>  --> -->
    <!-- added search by mmsi by copy past from ShipItem -->
  </div>
</template>

<script>
import axios from 'axios';
// import pako from 'pako'; // for Inflate and Deflate convert JSON to string



export default {
  name: 'AllShips',
  props: {
    msg6: String,
    
    
  },
  data: function() {
      return {
    allShips: null,
    allShips2: null, // added to try to do new list with coordinates /MMSI list
    allShips3: [], 
    newlist:[],
    allShipsMMSI: null,
    allShipsFirstVessel: null,
    nextID: 1,
    locbyMMSI : null,
    
    // newmmsi:356364000,
    currentDate:new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate(),
    yesterdayDate:this.currentDate-1,
    // newadress: `https://meri.digitraffic.fi/api/v1/port-calls/FIKOK?date=2020-03-09`,
    newadress: `https://meri.digitraffic.fi/api/v1/port-calls/FIKOK?date=` + new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate(),

    newadress2: `https://meri.digitraffic.fi/api/v1/locations/latest/` //+ 356364000, 10.03


   
      } //return end
      }, //data end
      created(){ //mikä se on?

       axios.get(this.newadress)  //FIKOK by date
          // DATE has to change!
          //how to do list from it?
      
.then(response => {
  console.log(this.currentDate)
this.allShipsFirstVessel = response.data.portCalls[0].vesselName // how to do for all list
this.allShipsMMSI = response.data.portCalls[0].mmsi
this.allShips = response.data.portCalls
// console.log(this.allShips)
// console.log(this.newadress2+244017000)

this.allShips2=this.allShips.map(function(allShips) { 

  return `https://meri.digitraffic.fi/api/v1/locations/latest/`+allShips.mmsi;
 });


for (var i=0; i<this.allShips2.length; i++) {
// console.log('TRY ALL SHIPS' + this.allShips[i])
 axios.get(this.allShips2[i]) //MMSI{356364000}

.then(response => {

this.locbyMMSI = response.data.features[0].geometry.coordinates //[ 23.02774, 63.864088 ]

this.newlist.push(this.locbyMMSI)
// this.allShips3.push({id: this.nextID, mmsi:this.allShips[i].mmsi, name:this.allShips[i].vesselName, loc:this.locbyMMSI })
this.allShips3.push({id: this.nextID, loc:this.locbyMMSI})  //now in allShips2 only htpp addreses   this.nextID++;
//  this.newlist.push({id: this.nextID, name:this.locbyMMSI})
 this.nextID++;
    // if (this.i==this.allShips2.length){
  // let hsData= pako.deflate(JSON.stringify(this.newlist), {to : 'string'});
     console.log('newlist from response'+ this.newlist) 

     //11.03 18:37 try to safe to local storage, its ok
      const data = JSON.stringify(this.newlist)
        window.localStorage.setItem('newlist', data);
        console.log(JSON.parse(window.localStorage.getItem('newlist')))
    //  console.log('hsData from response'+ this.hsData) 
     
    //  axios.post({
    //               url:"textwriter.php", // sivu joka kirjoittaa highscoren tekstitiedostoon
    //               type: "post",
    //               dataType: 'text',
    //               data: {newlist:this.newlistnewlist},//if i =this.allShips2.length
    //               success: function(result) {
    //                 if (result === "OK") {
    //                     console.log("newlist tallennettu: " + result);
    //                     // nollataan ja käynnistetään peli uudelleen highscoren tallennuksen jälkeen
    //                     // this.restart();
    //                     // this.coordinates = []; // tyhjennetään highscore-taulukko
    //                     // this.loadHighscore(); // ladataan taulukkoon uudet tiedot tiedostosta
    //                 }
    //                 else
    //                     console.log("newlist tallennus epäonnistui: " + result);
    //             }.bind(this),
    //             error: function() {
    //                 console.log("newlist tallennus epäonnistui!");
    //             }
    // }).then((response)=>{response.data=JSON.parse(pako.inflate(response.data, {to:'string'}));
    // console.log(response.data);
    // return response;
    // }
    // );
 }) //response end
 .catch (function(error){
   console.log(error);
 }); // catch end

          } //for end

// }//response end
}).catch (function(error){
   console.log(error);
 });// catch end

}// created end

   } //export default end

</script>
<style >
div.allships {
    border: 3px solid red;
    padding: 20px;
    text-align: left;
    /* display: inline-block; */
}

</style>
