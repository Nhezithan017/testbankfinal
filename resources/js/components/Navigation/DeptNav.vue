<template>
      <v-btn-toggle>
             <router-link :to="{name: 'department' }">
                <v-btn round color="success" dark><v-icon right small dark>menu </v-icon>My Department</v-btn>
            </router-link>
              <router-link :to="{name: 'add-dept' }">
            <v-btn round color="primary" dark><v-icon right small dark>add </v-icon>Add Department</v-btn>
            </router-link>
            </v-btn-toggle>
</template>

<script>
export default {
    
}
</script>
