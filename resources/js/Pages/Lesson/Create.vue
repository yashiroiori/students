<template>
    <Layout>
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header text-white d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">Materia</div>
                        <h2 class="page-title">Nueva materia</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Formulario</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Nombre</label>
                            <div class="col">
                                <b-form-input id="name" v-model="form.name" placeholder="Ingrese el nombre de la materia" :state="form.errors.name ? false : null"></b-form-input>
                                <b-form-invalid-feedback id="name-feedback">{{ form.errors.name }}</b-form-invalid-feedback>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <Link :href="route('student.index')" as="button" class="btn btn-link">Cancelar</Link>
                            <b-button @click="onSubmit" variant="primary" class="ms-auto" :disabled="form.processing">
                                <b-spinner small v-show="form.processing" style="margin-right: 8px;"></b-spinner>
                                Guardar
                            </b-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>

import { Link } from '@inertiajs/inertia-vue';

export default {
    components: {
        Link,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
            }),
        }
    },
    methods: {
        onSubmit() {
            this.form.post(route('lesson.store'),{
                preserveScroll: true,
                preserveState: true,
            });
        },
    },
}

</script>