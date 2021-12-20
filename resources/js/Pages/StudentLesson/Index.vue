<template>
    <Layout>
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header text-white d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">Estudiantes - Materias</div>
                        <h2 class="page-title">Asignación de materias</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Seleccione una materia</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Materia</label>
                            <div class="col">
                                <b-form-select v-model="form.lesson_id" class="form-control" @change="onLessonSelect">
                                    <b-form-select-option :value="null">Selecciona una materia...</b-form-select-option>
                                    <b-form-select-option v-for="lesson in lessons" :value="lesson.value" :key="`option_${lesson.value}`">{{lesson.text}}</b-form-select-option>
                                </b-form-select>
                            </div>
                        </div>
                    </div>
                    <template v-if="form.lesson_id">
                        <div class="card-header">
                            <h4 class="card-title">Asignación de alumnos para la materia</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                <label class="form-selectgroup-item flex-fill" v-for="student in students">
                                    <input type="checkbox" name="form-project-manager[]" :value="student.id" class="form-selectgroup-input" :checked="form.students.includes(student.id)" @change="(e) => onStudentLessonChange(e,student.id)" />
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <div>
                                                <div class="font-weight-medium">{{student.name}}</div>
                                                <div class="text-muted">{{student.email}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <b-button @click="onSubmit" variant="primary" class="ms-auto" :disabled="form.processing">
                                    <b-spinner small v-show="form.processing" style="margin-right: 8px;"></b-spinner>
                                    Guardar
                                </b-button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>

export default {
    props: {
        lessons: Array,
        students: Array,
        students_lesson: Array,
        lesson_id: Number,
    },
    updated(){
        this.form.students = this.students_lesson;
    },
    data(){
        return{
            search: '',
            form: this.$inertia.form({
                lesson_id: this.lesson_id,
                students: this.students_lesson,
            }),
        };
    },
    computed: {
        availableOptions() {
            return this.students.filter(opt => this.form.students.indexOf(opt) === -1)
        }
    },
    methods: {
        onLessonSelect(){
            this.$inertia.visit(route('student.lesson.index',{lesson_id: this.form.lesson_id}), {
                replace: true,
                preserveScroll: true,
                preserveState: true,
            });
        },
        onStudentLessonChange(e,id){
            if(e.target.checked == false){
                this.form.students.splice(this.form.students.indexOf(id), 1);
            }else{
                this.form.students.push(id);
            }
        },
        onSubmit(){
            this.form.post(route('student.lesson.store'),{
                preserveScroll: true,
                onSuccess: function(){
                    Toast.fire({
                        icon: 'success',
                        title: 'Asignación de alumnos en materia realizado',
                    })
                },
            });
        },
    },
}

</script>