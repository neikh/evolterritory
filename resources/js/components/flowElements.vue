<template>
  <div class="card red lighten-2">
    <div class="card-content white-text">
      <span class="card-title">{{ pensee.user.name }}</span>
      <p>{{ pensee.text }}</p>
      <p><small>{{ pensee.created_at }}</small></p>
    </div>
    <div v-if="deletable" class="card-action">
      <a href="#" @click.prevent="deletePensee">Supprimer cette pensée</a>
    </div>
  </div>
</template>
<script>
  export default {
    props: ['titre', 'description']
  }
</script>
