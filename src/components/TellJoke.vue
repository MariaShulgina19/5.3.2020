<template>
  <div class="joke">
    <h5>{{ setup }}</h5>
    <h3>{{ punchline }}</h3>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'TellJoke',
  data: function() {
      return {
    setup: null,
    punchline: null
      }
      },
      created(){ //mikä se on?
          this.setup="..almost there"
          axios.get('https://official-joke-api.appspot.com/jokes/programming/random')
.then(response => {
this.setup = response.data[0].setup
this.punchline=response.data[0].punchline
})
}


      }
  

</script>
<style >
div.joke {
    border: 3px solid rgb(17, 17, 17);
    margin: 20px;
    padding: 20px;
    display: inline-block;
}

</style>
