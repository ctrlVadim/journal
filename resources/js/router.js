import VueRouter from 'vue-router';
import Vue from 'vue';

import Index from "./views/Index";

import Student from "./views/Student";
import StudentSingle from "./views/StudentSingle";

import Grade from "./views/Grade";
import GradeSingle from "./views/GradeSingle";

import Speciality from "./views/Speciality";
import SpecialitySingle from "./views/SpecialitySingle";

import Subject from "./views/Subject";
import SubjectSingle from "./views/SubjectSingle";


Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'index',
        component: Index
    },
    {
        path: '/student',
        name: 'student',
        component: Student
    },
    {
        path: '/student/:id',
        name: 'student.view',
        component: StudentSingle
    },
    {
        path: '/grade',
        name: 'grade',
        component: Grade
    },
    {
        path: '/student/:id',
        name: 'student.view',
        component: GradeSingle
    },
    {
        path: '/subject',
        name: 'subject',
        component: Subject
    },
    {
        path: '/subject/:id',
        name: 'subject.view',
        component: SubjectSingle
    },
    {
        path: '/speciality',
        name: 'speciality',
        component: Speciality
    },
    {
        path: '/speciality/:id',
        name: 'speciality.view',
        component: SpecialitySingle
    },
];

export default new VueRouter({
    mode: "history",
    linkExactActiveClass: 'active',
    routes
})
