<template>
    <form  @submit.prevent="uploadCsv" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="csv_file" class="form-control-label">{{ $t('select') +' '+ $t('csv')+' '+ $t('file') }} <span class="text-red">*</span></label>

                    <div class="custom-file">
                        <input required type="file" class="custom-file-input" id="csv_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                        @change="onFileChange"
                        >
                        <label class="custom-file-label" for="csv_file">Select file</label>
                    </div>
                    <has-error :errors="errors" :field="'csvFile'"></has-error>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <argon-button :loading="busy" type="outline-primary">
                        {{ $t('Upload') }}
                    </argon-button>
                </div>
            </div>
        </div>

    </form>
</template>

<script>
export default {
    name: "CustomersUpload",
    props:{
        csvFile:{

        }
    },
    data() {
        return {
            msg:'',
            busy:false,
            errors :{},
            file:null
        }
    },
    methods:{
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length){
                return;
            }

            this.file = files[0];
        },
        async uploadCsv(){
            this.busy = true;
            let formData = new FormData();
            formData.append("csvFile", this.file);
            const {data} = await this.$axios.post('customers/import', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });

            if(data.status) {
                this.$global.alertSuccess(data.msg, '/customers', this.$router);
            }
            this.validationErrors(data);
            this.busy = false;
        },
        validationErrors(data){
            this.errors = {};
            if(data.data && data.data.errors && data.data.errors.validations) {
                this.errors = data.data.errors.validations;
            }
        },
    }
}
</script>

<style scoped>

</style>
