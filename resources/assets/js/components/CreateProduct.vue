<template>
    <div>
        <div class="row">
            <div class="col-md-7">

                <form class="form-horizontal" :id="name" :name="name" :action="action" method="POST">
                    <input type="hidden" name="_token" :value="csrf"">
                    <fieldset>
                        <legend>Novo Pedido</legend>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="company_id">Empresa</label>
                            <div class="col-md-5">
                                <vselect name="company_id" v-model="company_id" label="-- Selecione uma empresa --" :data="listCompanies"></vselect>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="product_id">Produto</label>
                            <div class="col-md-5">
                                <vselect name="product_id" v-model="product_id" label="-- Selecione um produto --" :data="listProducts" @changed="updateSelected"></vselect>
                            </div>
                            <label class="col-md-1 control-label" for="quantity">QTD</label>  
                            <div class="col-md-2">
                                <input v-model="quantity" name="quantity" placeholder="QTD" class="form-control input-md" type="text">
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" name="products" :value="JSON.stringify(this.selectedProducts)">
                                <button type="button" class="btn btn-link" v-on:click="addProduct()">Adicionar</button>
                            </div>
                        </div>

                        <h4>Lista de compras</h4>

                        <div class="col-md-10">
                            <vtable :columns="['Produto', 'QTD']" :data="listSelectedData"></vtable>
                        </div>

                        <div class="form-group control-label col-md-4">
                            <button :disabled="selectedData.length == 0" v-on:click="submitForm($event)" type="submit" class="btn btn-primary">Fechar pedido</button>
                        </div>

                        <div v-if="listErrors.length > 0" class="col-md-12 alert alert-danger reset-m m-10">
                            <h5>Lista de erros</h5>
                            <ul>
                                <li v-for="(error, index) in listErrors">{{ error }}</li>
                            </ul>
                        </div>

                    </fieldset>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["name", "action", "csrf", "dataCompanies", "dataProducts"],
    data() {
        return {
            company_id: "",
            product_id: "",
            quantity: 1,

            defaultDataCompanies: [],
            defaultDataProducts: [],
            selectedData: [],
            selectedDataName: '',
            selectedProducts: [],

            pageErros: [],
        };
    },
    methods: {
        updateSelected(data) {
            this.selectedDataName = data;
        },
        resetErrors() {
            this.pageErros = []; // reset list errors
        },
        validateEntry(product, quantity) {
            this.resetErrors();
            if (product == 0) {
                this.pageErros.push("Selecione um PRODUTO");
            }
            if (quantity <= 0) {
                this.pageErros.push("Informe uma QUANTIDADE válida");
            }

            return this.pageErros.length > 0 ? false : true;
        },
        addProduct() {
            let _product =
                    this.product_id != 0 && this.product_id != ""
                        ? this.product_id
                        : 0,
                _quantity = parseInt(this.quantity) || 0;

            if (this.validateEntry(_product, _quantity)) {
                let existsRow = this.existsRowProduct(_product);

                if (existsRow !== -1) {
                    this.selectedData[existsRow].quantity += _quantity;
                    this.selectedProducts[existsRow].quantity += _quantity;
                } else {
                    this.selectedProducts.push({
                        id: _product,
                        quantity: _quantity
                    });
                    this.selectedData.push({
                        id: _product,
                        name: this.selectedDataName,
                        quantity: _quantity
                    });
                }
            }
        },
        removeRow(row) {
            this.resetErrors();
            this.selectedData.splice(row, 1); // remove item at index
            this.selectedProducts.splice(row, 1); // remove item at index
            console.log(this.selectedProducts);
        },
        existsRowProduct(productID) {
            if (this.selectedData.length > 0) {
                return this.selectedData.findIndex(
                    item => item.id == productID
                ); // -1 || index
            }
            return -1;
        },
        submitForm(event) {
            if (event) event.preventDefault();
            this.resetErrors();

            let _company =
                this.company_id != 0 && this.company_id != ""
                    ? this.company_id
                    : 0;

            if (_company == 0) {
                this.pageErros.push("Informe uma EMPRESA válida");
            } else {
                document.getElementById("" + this.name).submit();
            }
        }
    },
    computed: {
        listCompanies() {
            this.defaultDataCompanies = this.dataCompanies;
            return this.defaultDataCompanies;
        },
        listProducts() {
            this.defaultDataProducts = this.dataProducts;
            return this.defaultDataProducts;
        },
        listSelectedData() {
            return JSON.stringify(this.selectedData);
        },
        listErrors() {
            return this.pageErros;
        }
    }
}
</script>>
