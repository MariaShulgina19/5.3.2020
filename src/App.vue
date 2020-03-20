<template>
  <div id="app">
    
    <HelloWorld msg="HARBOUR TODAY"/>
    <AllShips msg6="Vessels called to Port / mmsi if availabe" />
    <AllShipsFromPosition />
    <map2to-test msg7="Map2toTest"  />
    
    
  </div>
</template>

<script>

import HelloWorld from './components/HelloWorld.vue'
import AllShips from './components/AllShips.vue'
import AllShipsFromPosition from './components/AllShipsFromPosition.vue'
import Map2toTest from './components/Map2toTest.vue'

export default {
  name: 'App',
  Shipslist: [], //6.3.2020
  components: {
    HelloWorld,
    AllShips,
    Map2toTest,
    AllShipsFromPosition ,
    
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
