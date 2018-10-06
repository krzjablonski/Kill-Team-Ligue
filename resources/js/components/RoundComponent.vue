<template>
  <div class="table-wrapper">
    <div v-if="success" class="alert alert-success mt-2" role="alert">
      Parings where saved!
    </div>
    <div v-if="!errorEmpty()" class="alert alert-danger mt-2" role="alert">
      {{error}}
    </div>
    <table class="table mt-2">
      <thead>
        <tr>
          <th>#</th>
          <th>Player A Name</th>
          <th>Player B Name</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="paring in parings">
          <td>{{paring.id}}</td>
          <td>
            {{paring.PlayerA_Name}}<br>
            <small>{{paring.PlayerA_Army}}</small>
          </td>
          <td>
            {{paring.PlayerB_Name}}<br>
            <small>{{paring.PlayerB_Army}}</small>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
    export default {
      props: {
        parings: '',
        success: {
          type: Boolean,
          default: false
        },
        error: ''
      },
      watch: {
        parings: function(val){
          return this.parings = val
        },
        success: function(val){
          return this.success = val
        },
        error: function(val){
          return this.error = val
        }
      },
      methods: {
        errorEmpty: function() {
          return _.isEmpty(this.error)
        }
      }
    }
</script>
