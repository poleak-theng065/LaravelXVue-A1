<template>
    <div class="relative overflow-x-auto p-4">
        <!-- ADD OR EDIT BOOK FORM -->
        <div v-if="isFormShow" class="border p-4 rounded-md shadow-md bg-white w-full max-w-md mx-auto z-20 relative">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-blue-700">
                    {{ isEditing ? 'Edit Book' : 'Add a New Book' }}
                </h2>
                <button @click="closeForm" class="text-gray-400 hover:text-red-500 text-xl">&times;</button>
            </div>
            <form @submit.prevent="isEditing ? updateBook() : submitBook()">
                <!-- form fields same as before -->
                <div class="mb-2">
                    <label class="block text-sm text-gray-700 mb-1">Title</label>
                    <input v-model="newBook.title" type="text" class="w-full px-3 py-2 border rounded-md" required />
                </div>
                <div class="mb-2">
                    <label class="block text-sm text-gray-700 mb-1">Author</label>
                    <input v-model="newBook.author" type="text" class="w-full px-3 py-2 border rounded-md" required />
                </div>
                <div class="mb-2">
                    <label class="block text-sm text-gray-700 mb-1">ISBN</label>
                    <input v-model="newBook.ISBN" type="text" class="w-full px-3 py-2 border rounded-md" />
                </div>
                <div class="mb-2">
                    <label class="block text-sm text-gray-700 mb-1">Category</label>
                    <select v-model="newBook.category" class="w-full px-3 py-2 border rounded-md" required>
                        <option value="" disabled>Select category</option>
                        <option v-for="item in priorities" :key="item" :value="item">{{ item }}</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="block text-sm text-gray-700 mb-1">Publication Year</label>
                    <input v-model.number="newBook.publication_year" type="number"
                        class="w-full px-3 py-2 border rounded-md" />
                </div>
                <div class="mb-2">
                    <label class="block text-sm text-gray-700 mb-1">Available Copies</label>
                    <input v-model.number="newBook.available_copies" type="number"
                        class="w-full px-3 py-2 border rounded-md" />
                </div>
                <div class="mb-2">
                    <label class="block text-sm text-gray-700 mb-1">Image URL</label>
                    <input v-model="newBook.image" type="text" class="w-full px-3 py-2 border rounded-md" />
                </div>
                <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    {{ isEditing ? 'Update' : 'Save' }}
                </button>
            </form>
        </div>

        <!-- TABLE VIEW -->
        <div>
            <div class="flex justify-between item-center p-1">

                <!-- ///Search /// -->
                <div class="mb-4">
                    <input v-model=" searchQuery" type="search"
                        class="bg-gray-200 border-2 border-blue-400 rounded-full px-4 py-2 w-100 "
                        placeholder="Search by author or ISBN" />
                </div>
<!-- -------------------------//// -->
                <div class="flex justify-end items-center gap-4">
                    <select v-model="selectedCategory"
                        class="bg-gray-200 border-2 border-blue-400 rounded-full px-3 py-1.5 w-100">
                        <option value="">All categories</option>
                        <option v-for="item in priorities" :key="item" :value="item">{{ item }}</option>
                    </select>

                    <button @click="openAddForm"
                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-5 rounded-md">
                        + Add Book
                    </button>
                </div>
            </div>

            <div class="text mb-2 mt-4">
                <h1 class="text-3xl text-blue-600 font-semibold">Table Book:</h1>
            </div>

            <table class="min-w-full border border-gray-400 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-blue-200 text-left text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Author</th>
                        <th class="px-4 py-3">ISBN</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Publication Year</th>
                        <th class="px-4 py-3">Available Copies</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800 divide-y divide-gray-100 bg-white">
                    <tr v-for="book in filteredBooks" :key="book.id" class="hover:bg-blue-50">
                        <td class="border-gray-400 px-4 py-3"><img :src="book.image" alt=""
                                class="h-24 w-16 object-cover" /></td>
                        <td class="border-gray-400 px-4 py-3">{{ book.title }}</td>
                        <td class="border-gray-400 px-4 py-3">{{ book.author }}</td>
                        <td class="border-gray-400 px-4 py-3">{{ book.ISBN }}</td>
                        <td class="border-gray-400 px-4 py-3">{{ book.category }}</td>
                        <td class="border-gray-400 px-4 py-3">{{ book.publication_year }}</td>
                        <td class="border-gray-400 px-4 py-3">{{ book.available_copies }}</td>
                        <td class="border-gray-400 px-4 py-3">
                            <div class="relative">
                                <button @click="toggleMenu(book.id)" class="text-gray-600 hover:text-black">
                                    <span class="material-symbols-outlined text-xl">more_vert</span>
                                </button>
                                <div v-if="openMenuId === book.id"
                                    class="absolute right-0 mt-2  rounded p-2 flex flex-col gap-1 z-20">
                                    <button @click="editBook(book)"
                                        class="flex items-center gap-1 px-1 py-0.5 text-white text-xs rounded ">
                                        <span class="material-symbols-outlined text-black">edit</span>
                                    </button>
                                    <button @click="deleteBook(book.id)"
                                        class="flex items-center gap-1 px-1 py-0.5 text-white text-xs rounded ">
                                        <span class="material-symbols-outlined text-black">delete</span>
                                    </button>
                                    <button @click="showBook(book.id)"
                                        class="flex items-center gap-1 px-1 py-0.5  text-white text-xs rounded">
                                        <span class="material-symbols-outlined text-black">visibility</span>Show
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Floating Book Info Panel -->
        <transition name="fade">
            <div v-if="isShowInfoVisible && selectedBook"
                class="fixed top-20 right-4 max-w-xs w-72 bg-white border border-gray-300 rounded shadow-lg p-4 z-50">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold text-blue-600">Book Details</h3>
                    <button @click="isShowInfoVisible = false"
                        class="text-red-500 hover:underline text-sm">Close</button>
                </div>
                <img :src="selectedBook.image" alt="Book Image" class="w-full h-48 object-cover rounded mb-3" />
                <ul class="text-sm text-gray-700 space-y-1">
                    <li><strong>Title:</strong> {{ selectedBook.title }}</li>
                    <li><strong>Author:</strong> {{ selectedBook.author }}</li>
                    <li><strong>ISBN:</strong> {{ selectedBook.ISBN }}</li>
                    <li><strong>Category:</strong> {{ selectedBook.category }}</li>
                    <li><strong>Year:</strong> {{ selectedBook.publication_year }}</li>
                    <li><strong>Available Copies:</strong> {{ selectedBook.available_copies }}</li>
                </ul>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import Search from "./Search.vue";
import axios from "axios";

const apiBase = "http://192.168.108.91:8000/api/books";

const books = ref([]);
const isFormShow = ref(false);
const isEditing = ref(false);
const openMenuId = ref(null);
const priorities = ref(["Science", "Math", "History", "Programming"]);
const selectedCategory = ref("");
const searchQuery = ref('')

const filteredBooks = computed(() => {
  return books.value.filter((book) => {
    const matchesCategory = !selectedCategory.value || book.category === selectedCategory.value;
    const query = searchQuery.value.toLowerCase();
    const matchesSearch =
      book.author.toLowerCase().includes(query) ||
      book.ISBN.toLowerCase().includes(query);
    return matchesCategory && matchesSearch;
  });
});




const newBook = ref({
    id: null,
    title: "",
    author: "",
    ISBN: "",
    category: "",
    publication_year: null,
    image: "",
    available_copies: null,
});

const selectedBook = ref(null);
const isShowInfoVisible = ref(false);


const loadBooks = async () => {
    try {
        const res = await axios.get(apiBase);
        books.value = res.data.data;
    } catch (error) {
        console.error("Failed to load books:", error);
    }
};

const submitBook = async () => {
    try {
        const res = await axios.post(apiBase, newBook.value);
        books.value.push(res.data.data);
        closeForm();
    } catch (error) {
        console.error("Failed to submit book:", error.response?.data || error.message);
    }
};

const showBook = async (id) => {
    try {
        const res = await axios.get(`${apiBase}/${id}`);
        selectedBook.value = res.data.data;
        isShowInfoVisible.value = true;
    } catch (error) {
        console.error("Failed to fetch book:", error.response?.data || error.message);
    }
};

const editBook = (book) => {
    newBook.value = { ...book };
    isFormShow.value = true;
    isEditing.value = true;
};

const updateBook = async () => {
    try {
        const res = await axios.put(`${apiBase}/edit/${newBook.value.id}`, newBook.value);
        const index = books.value.findIndex((b) => b.id === newBook.value.id);
        if (index !== -1) books.value[index] = res.data.data;
        closeForm();
    } catch (error) {
        console.error("Failed to update book:", error.response?.data || error.message);
    }
};

const deleteBook = async (id) => {
    if (!confirm("Are you sure you want to delete this book?")) return;

    try {
        await axios.delete(`${apiBase}/delete/${id}`);
        books.value = books.value.filter((book) => book.id !== id);
    } catch (error) {
        console.error("Failed to delete book:", error.response?.data || error.message);
    }
};

const toggleMenu = (id) => {
    openMenuId.value = openMenuId.value === id ? null : id;
};

const openAddForm = () => {
    resetForm();
    isFormShow.value = true;
    isEditing.value = false;
};

const closeForm = () => {
    isFormShow.value = false;
    resetForm();
    isEditing.value = false;
};

const resetForm = () => {
    newBook.value = {
        id: null,
        title: "",
        author: "",
        ISBN: "",
        category: "",
        publication_year: null,
        image: "",
        available_copies: null,
    };
};



onMounted(() => {
    loadBooks();
});
</script>

<style scoped>
input:focus,
select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 1px #3b82f6;
}

/* Fade transition */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
