<template>
    <div>
        <select
            :id="name"
            :name="name"
            ref="elSelect"
            v-on:change="dataUpdate"
            v-model="selected"
            class="form-control">
            <option value="0">{{ label }} </option>
            <option v-for="(item, index) in list" :value="item.id" :data-index="index">
                {{ item.name }}
            </option>
        </select>
    </div>
</template>

<script>
   export default {
    props: ['name', 'data', 'label'],
    data() {
        return {
            defaultData: [],
            selected: 0,
            selectedName: ''
        }
    },
    computed: {
        list() {
            this.defaultData = JSON.parse(this.data);
            return this.defaultData;
        }
    },
    methods: {
        dataUpdate() {
            let _selected = this.$refs.elSelect,
                _name = _selected.children[_selected.selectedIndex].text,
                _id = this.selected;

            this.$emit('input', _id);
            this.$emit('changed', _name);
        }
    }
}
</script>
