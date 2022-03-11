import VueRouter from 'vue-router';
import Vue from 'vue';

import Student from "./views/Student/Student";
import StudentSingle from "./views/Student/StudentSingle";
import StudentCreate from "./views/Student/StudentCreate";

import Grade from "./views/Grade/Grade";
import GradeSingle from "./views/Grade/GradeSingle";
import GradeCreate from "./views/Grade/GradeCreate";

import Subject from "./views/Subject/Subject";
import SubjectSingle from "./views/Subject/SubjectSingle";
import SubjectCreate from "./views/Subject/SubjectCreate";

import Speciality from "./views/Speciality/Speciality";
import SpecialitySingle from "./views/Speciality/SpecialitySingle";
import SpecialityCreate from "./views/Speciality/SpecialityCreate";




Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'index',
        component: Student
    }, {
        path: '/student/view',
        name: 'student.view',
        component: StudentSingle
    }, {
        path: '/student/create',
        name: 'student.create',
        component: StudentCreate
    }, {
        path: '/student/:id/update',
        name: 'student.update',
        component: StudentCreate
    },


    {
        path: '/grade',
        name: 'grade',
        component: Grade
    }, {
        path: '/grade/view',
        name: 'grade.view',
        component: GradeSingle
    }, {
        path: '/grade/create',
        name: 'grade.create',
        component: GradeCreate
    }, {
        path: '/grade/:id/update',
        name: 'grade.update',
        component: GradeCreate
    },


    {
        path: '/subject',
        name: 'subject',
        component: Subject
    }, {
        path: '/subject/view',
        name: 'subject.view',
        component: SubjectSingle
    }, {
        path: '/subject/create',
        name: 'subject.create',
        component: SubjectCreate
    }, {
        path: '/subject/:id/update',
        name: 'subject.update',
        component: SubjectCreate
    },


    {
        path: '/speciality',
        name: 'speciality',
        component: Speciality
    }, {
        path: '/speciality/view',
        name: 'speciality.view',
        component: SpecialitySingle
    }, {
        path: '/speciality/create',
        name: 'speciality.create',
        component: SpecialityCreate
    }, {
        path: '/speciality/:id/update',
        name: 'speciality.update',
        component: SpecialityCreate
    },
];

export default new VueRouter({
    mode: "history",
    linkExactActiveClass: 'active',
    routes
})
