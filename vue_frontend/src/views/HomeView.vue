<template>
  <div class="overflow-x-auto p-4">
    <table class="min-w-full border border-gray-200 shadow-md rounded-lg overflow-hidden">
      <thead class="bg-blue-100 text-left text-sm font-semibold text-gray-700">
        <tr>
          <th class="px-4 py-3">Image</th>
          <th class="px-4 py-3">Title</th>
          <th class="px-4 py-3">Author</th>
          <th class="px-4 py-3">ISBN</th>
          <th class="px-4 py-3">Category</th>
          <th class="px-4 py-3">Publication Year</th>
          <th class="px-4 py-3">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm text-gray-800 divide-y divide-gray-100 bg-white">
        <tr v-for="book in books" :key="book.id" class="hover:bg-blue-50">
          <td class="px-4 py-3">{{ book.image }}</td>
          <td class="px-4 py-3">{{ book.title }}</td>
          <td class="px-4 py-3">{{ book.author }}</td>
          <td class="px-4 py-3">{{ book.ISBN }}</td>
          <td class="px-4 py-3">{{ book.category }}</td>
          <td class="px-4 py-3">{{ book.publication_year }}</td>
          <td class="px-4 py-3">
            <div class="flex gap-1">
              <!-- Edit Button -->
              <button
                class="flex items-center gap-1 px-2 py-1 bg-green-500 text-white text-[13px] rounded hover:bg-green-600">
                <span class="material-symbols-outlined text-[16px]">edit</span>
              </button>

              <!-- Delete Button -->
              <button class="flex items-center gap-1 px-1 py-0.5 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                <span class="material-symbols-outlined text-sm">delete</span>
              </button>

              <!-- Show Button -->
              <button class="flex items-center gap-1 px-1 py-0.5 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">
                <span class="material-symbols-outlined text-sm">visibility</span>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const books = ref([]);

onMounted(async () => {
  try {
    const res = await axios.get("http://192.168.108.62:8000/api/books");
    books.value = res.data;
  } catch (e) {
    console.log("Error fetching data", e);
  }
});
</script>
