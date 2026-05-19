<template>
  <div>
    <h3 class="page-title">Hình ảnh bàn giao</h3>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <before-after-upload
              v-model="pairs"
              title="album-affter"
              :show-title="true"
            />

            <div style="margin-top: 16px;">
              <vs-button color="primary" @click="save">Lưu</vs-button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
  name: 'albumAffter',
  data() {
    return {
      pairs: [],
    };
  },
  methods: {
    ...mapActions(['saveAlbumAffter', 'listAlbumAffter', 'loadings']),
    load() {
      this.loadings(true);
      this.listAlbumAffter().then(response => {
        this.loadings(false);
        const data = response.data || [];
        if (data.length) {
          // Nếu dữ liệu cũ lưu dạng { image, name, link, status }
          // thì map sang dạng { before, after, title, status }
          this.pairs = data.map((item, i) => {
            if (item.before !== undefined || item.after !== undefined) {
              return item; // đã đúng định dạng before/after
            }
            // chuyển đổi định dạng cũ
            return {
              before: item.image || '',
              after:  '',
              title:  item.name  || '',
              status: item.status != null ? item.status : 1,
              uid:    `pair-index-${i}`,
            };
          });
        } else {
          this.pairs = [];
        }
      }).catch(() => { this.loadings(false); });
    },
    save() {
      this.loadings(true);
      // Lưu dưới dạng mảng before/after pairs
      this.saveAlbumAffter({ data: this.pairs }).then(() => {
        this.loadings(false);
        this.$success('Lưu thành công');
      }).catch(() => {
        this.loadings(false);
        this.$error('Lưu thất bại');
      });
    },
  },
  mounted() {
    this.load();
  },
};
</script>
