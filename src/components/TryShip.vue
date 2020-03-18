<template>
  <div class="ship">
    <h5>{{ msg2 }}</h5>
    <h5>{{ portCallsUpdated }}</h5>
    <h5>{{ msg3 }}</h5>
    <h5>{{ portCallId}} {{portToVisit }} {{ vesselName }}</h5>
    <!-- <h3>{{ punchline }}</h3> -->
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'TryShip',
  props: {
    msg2: String,
    msg3: String
  },
  data: function() {
      return {
    portCallsUpdated: null,
    portCallId: null,
    portToVisit: null,
    vesselName: null
      }
      },
      created(){ //mikä se on?
          this.setup="..almost there"
          axios.get('https://meri.digitraffic.fi/api/v1/port-calls')
.then(response => {
this.portCallsUpdated = response.data.portCallsUpdated
this.portCallId = response.data.portCalls[0].portCallId
this.portToVisit = response.data.portCalls[0].portToVisit
this.vesselName = response.data.portCalls[0].vesselName
// this.punchline=response.data[0].punchline
})
}



      }
  

</script>
<style >
div.ship {
    border: 3px solid rgb(17, 17, 17);
    padding: 20px;
    /* display: inline-block; */
}

</style>
