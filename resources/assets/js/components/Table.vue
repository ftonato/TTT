<template>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th v-for="(title, index) in columns">{{ title }}</th>
                    <th class="text-center">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="list.length == 0">
                    <td colspan="3" class="warning">Nenhum produto inserido até o momento!</td>
                </tr>
                <tr v-if="list.length > 0" v-for="(item, listIdx) in list">
                    <td v-for="(i, idx) in item" v-if="idx != 'id'" :data-value="i">
                        {{i}}
                    </td>
                    <td class="text-center">
                        <a v-on:click="$parent.removeRow(listIdx)" class="btn btn-danger">Remove</a>
                    </td>
              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
   export default {
    props: ['columns', 'data'],
    data() {
        return {
            defaultData: []
        }
    },
    computed: {
        list() {
            this.defaultData = JSON.parse(this.data);
            return this.defaultData;
        }
    }
}
</script>
