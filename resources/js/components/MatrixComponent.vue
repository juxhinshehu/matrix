<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Matrix Multiplier</div>

                    <div class="card-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="matrix1">Matrix 1:</label>
                                    <div class="col-sm-5">
                                      <textarea v-model="matrix1" rows="4" cols="10" id="matrix1" placeholder="1 2 3             4 5 6             7 8 9" ></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="matrix2">Matrix 2:</label>
                                    <div class="col-sm-5">
                                        <textarea v-model="matrix2" rows="4" cols="10" id="matrix2"
                                        placeholder="1 2 3             4 5 6             7 8 9" ></textarea>
                                    </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button class="btn btn-primary" v-on:click="multiply">Multiply</button>
                                </div>
                            </div>

                            <div class="form-group alert alert-danger" v-if="errors != ''">
                                <label class="control-label col-sm-10"> {{ this.errors }} </label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Result:</label>
                                    <div class="col-sm-5">
                                        <textarea rows="4" cols="10" id="matrix2"
                                        placeholder="result" > {{ multipicationRes}}</textarea>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        data() {
            return {
                matrix1: "",
                matrix2: "",
                multipicationRes: "",
                errors: "",            
            }
        },
        methods: {
            multiply (event) {
                event.preventDefault();
                let matrix1Array = this.stringToArray(this.matrix1);
                let matrix2Array = this.stringToArray(this.matrix2);
                
                $.ajax({
                    url: "/matrix/multiply",
                    type:"POST",
                    data:{
                        matrix1: matrix1Array,
                        matrix2: matrix2Array,
                    },
                    success: (response) => {
                        if (response) {
                            this.errors = "";
                            let resultAsString = this.arrayToString(response)
                            this.multipicationRes = resultAsString.trim();
                        }
                    },
                    error: (response) => {
                        if (response) {
                            var errorMsgs = "Error ";
                            this.multipicationRes = "";

                            for (let error in response.responseJSON.errors) {
                                for (var i = 0; i < response.responseJSON.errors[error].length; i++) {
                                    let err = response.responseJSON.errors[error][i];
                                    errorMsgs += err + " ";
                                }
                            }
                            
                            this.errors = errorMsgs;
                        }
                    },
                });
            },
            stringToArray (matrix) {
                let matrixArray = matrix.split("\n");
                for (var i = 0; i < matrixArray.length; i++) {
                    console.log(" 1111111 ", matrixArray[i])
                    matrixArray[i] = matrixArray[i].trim();
                    console.log(" 222222 ", matrixArray[i])
                    matrixArray[i] = matrixArray[i].split(" ")
                }
                return matrixArray;
            },
            arrayToString (matrix) {
                for (var i = 0; i < matrix.length; i++) {
                    matrix[i] = matrix[i].join(" ");
                }
                let matrixString = matrix.join("\n")
                return matrixString;
            }
  }
    }
</script>
