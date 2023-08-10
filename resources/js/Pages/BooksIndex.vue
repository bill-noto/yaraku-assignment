<script>
import {defineComponent} from 'vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import moment from 'moment';
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {library} from '@fortawesome/fontawesome-svg-core'
import {faEdit, faEye, faTrash} from '@fortawesome/free-solid-svg-icons'

library.add(faTrash, faEdit, faEye);

export default defineComponent({
    components: {
        FontAwesomeIcon,
        Head,
        Link,
    },
    props: {
        books: Object,
        authors: Object
    },
    data() {
        var date = new Date();
        const form = useForm({
            author_id: null,
            title: null,
        });
        return {
            year: date.getFullYear(),
            form
        }
    },
    methods: {
        format(param) {
            return moment(String(param)).format('DD/MM/YYYY LT')
        },
        deleteBook(id) {
            if (confirm('Are you sure you want to delete this book?')) {
                this.$inertia.delete(`/books/${id}`);
            }
        },
        addBook() {
            this.$inertia.get(`/books/create`);
        },
        expandBook(id) {
            this.$inertia.get(`/books/${id}`);
        },
        editBook(id) {
            this.$inertia.get(`/books/edit/${id}`);
        },
        submit() {
            this.form.post('/books/search');
        },
        refreshPage() {
            this.$inertia.get('/');
        }
    }
})
</script>

<template>
    <Head title="Books"/>

    <div class="my-4 flex justify-center items-center">
        <div class="w-full flex flex-col justify-center items-center">
            <div class="w-1/3">
                <form @submit.prevent="submit()" class="mx-10 my-10 flex flex-col">
                    <label for="title">Book to search for:</label>
                    <input v-model="this.form.title" type="text"
                           name="title" id="title"
                           class="w-full h-12 p-1">
                    <label for="author">Author to search for:</label>
                    <select class="w-full h-12 p-1" v-model="this.form.author_id" name="author" id="author">
                        <option v-for="author of authors" :value=author.id>{{ author.name }}</option>
                    </select>
                    <button type="submit"
                            class="inline-flex text-md transition-colors duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-current focus:outline-none rounded-md text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 w-1/3 mx-auto my-4">
                        Submit
                    </button>
                    <button class="inline-flex text-md transition-colors duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-current focus:outline-none rounded-md text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 w-1/3 mx-auto my-4" type="button"
                            @click="refreshPage()">
                        Refresh Page
                    </button>
                </form>
            </div>

            <table class="w-3/5 table-auto border border-black text-center">
                <thead>
                <tr>
                    <th class="border border-black">Title</th>
                    <th class="border border-black">Author</th>
                    <th class="border border-black">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="book in books" :key="book">
                    <td class="border border-black">{{ book.title }}</td>
                    <td class="border border-black">{{ book.author.name }}</td>
                    <td class="border border-black flex justify-around">
                        <button title="Expand Book" @click="expandBook(book.id)">
                            <font-awesome-icon icon="fa-solid fa-eye"/>
                        </button>
                        <button title="Edit Book" @click="editBook(book.id)">
                            <font-awesome-icon icon="fa-solid fa-edit"/>
                        </button>
                        <button title="Delete Book" @click="deleteBook(book.id)">
                            <font-awesome-icon icon="fa-solid fa-trash"/>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <button class="inline-flex text-md transition-colors duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-current focus:outline-none rounded-md text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 w-1/8 mx-auto my-4" type="button"
                    @click="addBook()">
                Add Book
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>
