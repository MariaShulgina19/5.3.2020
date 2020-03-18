<template>
  <div id="app">
    
    <HelloWorld msg="HARBOUR TODAY"/>
    <TellJoke/>
    <TryShip msg2="Data last update" msg3="PortCallsID / Port to visit / Vessel Name" />
    <AllShips msg6="ALL DATA" />
     <ShipItem msg8="Ship coordinates by mmsi" />
    <Map msg7="Map"  />
    
  </div>
</template>

<script>
// import * as ol from 'ol'; //importin openlayers library
import HelloWorld from './components/HelloWorld.vue'
import TellJoke from './components/TellJoke.vue'
import TryShip from './components/TryShip.vue'
import AllShips from './components/AllShips.vue'
import ShipItem from './components/ShipItem.vue'
import Map from './components/Map.vue'

export default {
  name: 'App',
  Shipslist: [], //6.3.2020
  components: {
    HelloWorld,
    TellJoke,
    TryShip,
    AllShips,
    ShipItem,
    Map
    
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
