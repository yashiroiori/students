<template>
    <Layout>
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header text-white d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">Estudiante</div>
                        <h2 class="page-title">Editar estudiante</h2>
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
                                <b-form-input id="name" v-model="form.name" placeholder="Ingrese el nombre del estudiante" :state="form.errors.name ? false : null"></b-form-input>
                                <b-form-invalid-feedback id="name-feedback">{{ form.errors.name }}</b-form-invalid-feedback>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Correo electrónico</label>
                            <div class="col">
                                <b-form-input id="email" v-model="form.email" placeholder="Ingrese el correo electrónico del estudiante" :state="form.errors.name ? false : null"></b-form-input>
                                <b-form-invalid-feedback id="email-feedback">{{ form.errors.email }}</b-form-invalid-feedback>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Contraseña</label>
                            <div class="col">
                                <b-form-input id="password" type="password" v-model="form.password" placeholder="Ingrese una contraseña" :state="form.errors.name ? false : null"></b-form-input>
                                <b-form-invalid-feedback id="password-feedback">{{ form.errors.password }}</b-form-invalid-feedback>
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
    props: {
        student: Object,
    },
    components: {
        Link,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.student.name,
                email: this.student.email,
                password: null,
            }),
        }
    },
    methods: {
        onSubmit() {
            this.form.put(route('student.update',this.student.id),{
                preserveScroll: true,
                preserveState: true,
            });
        },
    },
}

</script>