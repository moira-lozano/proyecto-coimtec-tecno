<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineOptions({
  layout: AuthenticatedLayout
});

defineProps({
  auth: Object
});
</script>
