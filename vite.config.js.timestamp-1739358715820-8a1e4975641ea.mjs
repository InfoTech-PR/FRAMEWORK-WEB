// vite.config.js
import laravel from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/laravel-vite-plugin/dist/index.js";
import { fileURLToPath } from "node:url";
import VueI18nPlugin from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/@intlify/unplugin-vue-i18n/lib/vite.mjs";
import vue from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import vueJsx from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/@vitejs/plugin-vue-jsx/dist/index.mjs";
import AutoImport from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/unplugin-auto-import/dist/vite.js";
import Components from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/unplugin-vue-components/dist/vite.js";
import { VueRouterAutoImports, getPascalCaseRouteName } from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/unplugin-vue-router/dist/index.mjs";
import VueRouter from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/unplugin-vue-router/dist/vite.mjs";
import { defineConfig } from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/vite/dist/node/index.js";
import Layouts from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/vite-plugin-vue-layouts/dist/index.mjs";
import vuetify from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/vite-plugin-vuetify/dist/index.mjs";
import svgLoader from "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/node_modules/vite-svg-loader/index.js";
var __vite_injected_original_import_meta_url = "file:///C:/Users/Infotech/Desktop/Josue%20Henrique/InfoTech/FRAMEWORK-WEB/vite.config.js";
var vite_config_default = defineConfig({
  plugins: [
    VueRouter({
      getRouteName: (routeNode) => {
        return getPascalCaseRouteName(routeNode).replace(/([a-z\d])([A-Z])/g, "$1-$2").toLowerCase();
      },
      beforeWriteFiles: (root) => {
        root.insert("/apps/email/:filter", "/resources/js/pages/apps/email/index.vue");
        root.insert("/apps/email/:label", "/resources/js/pages/apps/email/index.vue");
      },
      routesFolder: "resources/js/pages"
    }),
    vue({
      template: {
        compilerOptions: {
          isCustomElement: (tag) => tag === "swiper-container" || tag === "swiper-slide"
        },
        transformAssetUrls: {
          base: null,
          includeAbsolute: false
        }
      }
    }),
    laravel({
      input: ["resources/js/main.js"],
      refresh: true
    }),
    vueJsx(),
    vuetify({
      styles: {
        configFile: "resources/styles/variables/_vuetify.scss"
      }
    }),
    Layouts({
      layoutsDirs: "./resources/js/layouts/"
    }),
    Components({
      dirs: ["resources/js/@core/components", "resources/js/views/demos", "resources/js/components"],
      dts: true,
      resolvers: [
        (componentName) => {
          if (componentName === "VueApexCharts")
            return { name: "default", from: "vue3-apexcharts", as: "VueApexCharts" };
        }
      ]
    }),
    AutoImport({
      imports: ["vue", VueRouterAutoImports, "@vueuse/core", "@vueuse/math", "vue-i18n", "pinia"],
      dirs: [
        "./resources/js/@core/utils",
        "./resources/js/@core/composable/",
        "./resources/js/composables/",
        "./resources/js/utils/",
        "./resources/js/plugins/*/composables/*"
      ],
      vueTemplate: true,
      ignore: ["useCookies", "useStorage"],
      eslintrc: {
        enabled: true,
        filepath: "./.eslintrc-auto-import.json"
      }
    }),
    VueI18nPlugin({
      runtimeOnly: true,
      compositionOnly: true,
      include: [
        fileURLToPath(new URL("./resources/js/plugins/i18n/locales/**", __vite_injected_original_import_meta_url))
      ]
    }),
    svgLoader()
  ],
  define: { "process.env": {} },
  resolve: {
    alias: {
      "@core-scss": fileURLToPath(new URL("./resources/styles/@core", __vite_injected_original_import_meta_url)),
      "@": fileURLToPath(new URL("./resources/js", __vite_injected_original_import_meta_url)),
      "@themeConfig": fileURLToPath(new URL("./themeConfig.js", __vite_injected_original_import_meta_url)),
      "@core": fileURLToPath(new URL("./resources/js/@core", __vite_injected_original_import_meta_url)),
      "@layouts": fileURLToPath(new URL("./resources/js/@layouts", __vite_injected_original_import_meta_url)),
      "@images": fileURLToPath(new URL("./resources/images/", __vite_injected_original_import_meta_url)),
      "@styles": fileURLToPath(new URL("./resources/styles/", __vite_injected_original_import_meta_url)),
      "@configured-variables": fileURLToPath(new URL("./resources/styles/variables/_template.scss", __vite_injected_original_import_meta_url)),
      "@db": fileURLToPath(new URL("./resources/js/plugins/fake-api/handlers/", __vite_injected_original_import_meta_url)),
      "@api-utils": fileURLToPath(new URL("./resources/js/plugins/fake-api/utils/", __vite_injected_original_import_meta_url))
    }
  },
  build: {
    chunkSizeWarningLimit: 5e3,
    minify: false,
    // Desabilita minificação se for um erro
    sourcemap: true
  },
  optimizeDeps: {
    exclude: ["vuetify"],
    entries: [
      "./resources/js/**/*.vue"
    ]
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFxJbmZvdGVjaFxcXFxEZXNrdG9wXFxcXEpvc3VlIEhlbnJpcXVlXFxcXEluZm9UZWNoXFxcXEZSQU1FV09SSy1XRUJcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIkM6XFxcXFVzZXJzXFxcXEluZm90ZWNoXFxcXERlc2t0b3BcXFxcSm9zdWUgSGVucmlxdWVcXFxcSW5mb1RlY2hcXFxcRlJBTUVXT1JLLVdFQlxcXFx2aXRlLmNvbmZpZy5qc1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vQzovVXNlcnMvSW5mb3RlY2gvRGVza3RvcC9Kb3N1ZSUyMEhlbnJpcXVlL0luZm9UZWNoL0ZSQU1FV09SSy1XRUIvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJ1xuaW1wb3J0IHsgZmlsZVVSTFRvUGF0aCB9IGZyb20gJ25vZGU6dXJsJ1xuaW1wb3J0IFZ1ZUkxOG5QbHVnaW4gZnJvbSAnQGludGxpZnkvdW5wbHVnaW4tdnVlLWkxOG4vdml0ZSdcbmltcG9ydCB2dWUgZnJvbSAnQHZpdGVqcy9wbHVnaW4tdnVlJ1xuaW1wb3J0IHZ1ZUpzeCBmcm9tICdAdml0ZWpzL3BsdWdpbi12dWUtanN4J1xuaW1wb3J0IEF1dG9JbXBvcnQgZnJvbSAndW5wbHVnaW4tYXV0by1pbXBvcnQvdml0ZSdcbmltcG9ydCBDb21wb25lbnRzIGZyb20gJ3VucGx1Z2luLXZ1ZS1jb21wb25lbnRzL3ZpdGUnXG5pbXBvcnQgeyBWdWVSb3V0ZXJBdXRvSW1wb3J0cywgZ2V0UGFzY2FsQ2FzZVJvdXRlTmFtZSB9IGZyb20gJ3VucGx1Z2luLXZ1ZS1yb3V0ZXInXG5pbXBvcnQgVnVlUm91dGVyIGZyb20gJ3VucGx1Z2luLXZ1ZS1yb3V0ZXIvdml0ZSdcbmltcG9ydCB7IGRlZmluZUNvbmZpZyB9IGZyb20gJ3ZpdGUnXG5pbXBvcnQgTGF5b3V0cyBmcm9tICd2aXRlLXBsdWdpbi12dWUtbGF5b3V0cydcbmltcG9ydCB2dWV0aWZ5IGZyb20gJ3ZpdGUtcGx1Z2luLXZ1ZXRpZnknXG5pbXBvcnQgc3ZnTG9hZGVyIGZyb20gJ3ZpdGUtc3ZnLWxvYWRlcidcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgcGx1Z2luczogW1xuICAgIFZ1ZVJvdXRlcih7XG4gICAgICBnZXRSb3V0ZU5hbWU6IHJvdXRlTm9kZSA9PiB7XG4gICAgICAgIHJldHVybiBnZXRQYXNjYWxDYXNlUm91dGVOYW1lKHJvdXRlTm9kZSlcbiAgICAgICAgICAucmVwbGFjZSgvKFthLXpcXGRdKShbQS1aXSkvZywgJyQxLSQyJylcbiAgICAgICAgICAudG9Mb3dlckNhc2UoKVxuICAgICAgfSxcbiAgICAgIGJlZm9yZVdyaXRlRmlsZXM6IHJvb3QgPT4ge1xuICAgICAgICByb290Lmluc2VydCgnL2FwcHMvZW1haWwvOmZpbHRlcicsICcvcmVzb3VyY2VzL2pzL3BhZ2VzL2FwcHMvZW1haWwvaW5kZXgudnVlJylcbiAgICAgICAgcm9vdC5pbnNlcnQoJy9hcHBzL2VtYWlsLzpsYWJlbCcsICcvcmVzb3VyY2VzL2pzL3BhZ2VzL2FwcHMvZW1haWwvaW5kZXgudnVlJylcbiAgICAgIH0sXG4gICAgICByb3V0ZXNGb2xkZXI6ICdyZXNvdXJjZXMvanMvcGFnZXMnLFxuICAgIH0pLFxuICAgIHZ1ZSh7XG4gICAgICB0ZW1wbGF0ZToge1xuICAgICAgICBjb21waWxlck9wdGlvbnM6IHtcbiAgICAgICAgICBpc0N1c3RvbUVsZW1lbnQ6IHRhZyA9PiB0YWcgPT09ICdzd2lwZXItY29udGFpbmVyJyB8fCB0YWcgPT09ICdzd2lwZXItc2xpZGUnLFxuICAgICAgICB9LFxuICAgICAgICB0cmFuc2Zvcm1Bc3NldFVybHM6IHtcbiAgICAgICAgICBiYXNlOiBudWxsLFxuICAgICAgICAgIGluY2x1ZGVBYnNvbHV0ZTogZmFsc2UsXG4gICAgICAgIH0sXG4gICAgICB9LFxuICAgIH0pLFxuICAgIGxhcmF2ZWwoe1xuICAgICAgaW5wdXQ6IFsncmVzb3VyY2VzL2pzL21haW4uanMnXSxcbiAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgfSksXG4gICAgdnVlSnN4KCksXG4gICAgdnVldGlmeSh7XG4gICAgICBzdHlsZXM6IHtcbiAgICAgICAgY29uZmlnRmlsZTogJ3Jlc291cmNlcy9zdHlsZXMvdmFyaWFibGVzL192dWV0aWZ5LnNjc3MnLFxuICAgICAgfSxcbiAgICB9KSwgXG4gICAgTGF5b3V0cyh7XG4gICAgICBsYXlvdXRzRGlyczogJy4vcmVzb3VyY2VzL2pzL2xheW91dHMvJyxcbiAgICB9KSxcbiAgICBDb21wb25lbnRzKHtcbiAgICAgIGRpcnM6IFsncmVzb3VyY2VzL2pzL0Bjb3JlL2NvbXBvbmVudHMnLCAncmVzb3VyY2VzL2pzL3ZpZXdzL2RlbW9zJywgJ3Jlc291cmNlcy9qcy9jb21wb25lbnRzJ10sXG4gICAgICBkdHM6IHRydWUsXG4gICAgICByZXNvbHZlcnM6IFtcbiAgICAgICAgY29tcG9uZW50TmFtZSA9PiB7XG4gICAgICAgICAgaWYgKGNvbXBvbmVudE5hbWUgPT09ICdWdWVBcGV4Q2hhcnRzJylcbiAgICAgICAgICAgIHJldHVybiB7IG5hbWU6ICdkZWZhdWx0JywgZnJvbTogJ3Z1ZTMtYXBleGNoYXJ0cycsIGFzOiAnVnVlQXBleENoYXJ0cycgfVxuICAgICAgICB9LFxuICAgICAgXSxcbiAgICB9KSwgXG4gICAgQXV0b0ltcG9ydCh7XG4gICAgICBpbXBvcnRzOiBbJ3Z1ZScsIFZ1ZVJvdXRlckF1dG9JbXBvcnRzLCAnQHZ1ZXVzZS9jb3JlJywgJ0B2dWV1c2UvbWF0aCcsICd2dWUtaTE4bicsICdwaW5pYSddLFxuICAgICAgZGlyczogW1xuICAgICAgICAnLi9yZXNvdXJjZXMvanMvQGNvcmUvdXRpbHMnLFxuICAgICAgICAnLi9yZXNvdXJjZXMvanMvQGNvcmUvY29tcG9zYWJsZS8nLFxuICAgICAgICAnLi9yZXNvdXJjZXMvanMvY29tcG9zYWJsZXMvJyxcbiAgICAgICAgJy4vcmVzb3VyY2VzL2pzL3V0aWxzLycsXG4gICAgICAgICcuL3Jlc291cmNlcy9qcy9wbHVnaW5zLyovY29tcG9zYWJsZXMvKicsXG4gICAgICBdLFxuICAgICAgdnVlVGVtcGxhdGU6IHRydWUsXG4gICAgICBpZ25vcmU6IFsndXNlQ29va2llcycsICd1c2VTdG9yYWdlJ10sXG4gICAgICBlc2xpbnRyYzoge1xuICAgICAgICBlbmFibGVkOiB0cnVlLFxuICAgICAgICBmaWxlcGF0aDogJy4vLmVzbGludHJjLWF1dG8taW1wb3J0Lmpzb24nLFxuICAgICAgfSxcbiAgICB9KSxcbiAgICBWdWVJMThuUGx1Z2luKHtcbiAgICAgIHJ1bnRpbWVPbmx5OiB0cnVlLFxuICAgICAgY29tcG9zaXRpb25Pbmx5OiB0cnVlLFxuICAgICAgaW5jbHVkZTogW1xuICAgICAgICBmaWxlVVJMVG9QYXRoKG5ldyBVUkwoJy4vcmVzb3VyY2VzL2pzL3BsdWdpbnMvaTE4bi9sb2NhbGVzLyoqJywgaW1wb3J0Lm1ldGEudXJsKSksXG4gICAgICBdLFxuICAgIH0pLFxuICAgIHN2Z0xvYWRlcigpLFxuICBdLFxuICBkZWZpbmU6IHsgJ3Byb2Nlc3MuZW52Jzoge30gfSxcbiAgcmVzb2x2ZToge1xuICAgIGFsaWFzOiB7XG4gICAgICAnQGNvcmUtc2Nzcyc6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9yZXNvdXJjZXMvc3R5bGVzL0Bjb3JlJywgaW1wb3J0Lm1ldGEudXJsKSksXG4gICAgICAnQCc6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9yZXNvdXJjZXMvanMnLCBpbXBvcnQubWV0YS51cmwpKSxcbiAgICAgICdAdGhlbWVDb25maWcnOiBmaWxlVVJMVG9QYXRoKG5ldyBVUkwoJy4vdGhlbWVDb25maWcuanMnLCBpbXBvcnQubWV0YS51cmwpKSxcbiAgICAgICdAY29yZSc6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9yZXNvdXJjZXMvanMvQGNvcmUnLCBpbXBvcnQubWV0YS51cmwpKSxcbiAgICAgICdAbGF5b3V0cyc6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9yZXNvdXJjZXMvanMvQGxheW91dHMnLCBpbXBvcnQubWV0YS51cmwpKSxcbiAgICAgICdAaW1hZ2VzJzogZmlsZVVSTFRvUGF0aChuZXcgVVJMKCcuL3Jlc291cmNlcy9pbWFnZXMvJywgaW1wb3J0Lm1ldGEudXJsKSksXG4gICAgICAnQHN0eWxlcyc6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9yZXNvdXJjZXMvc3R5bGVzLycsIGltcG9ydC5tZXRhLnVybCkpLFxuICAgICAgJ0Bjb25maWd1cmVkLXZhcmlhYmxlcyc6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9yZXNvdXJjZXMvc3R5bGVzL3ZhcmlhYmxlcy9fdGVtcGxhdGUuc2NzcycsIGltcG9ydC5tZXRhLnVybCkpLFxuICAgICAgJ0BkYic6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9yZXNvdXJjZXMvanMvcGx1Z2lucy9mYWtlLWFwaS9oYW5kbGVycy8nLCBpbXBvcnQubWV0YS51cmwpKSxcbiAgICAgICdAYXBpLXV0aWxzJzogZmlsZVVSTFRvUGF0aChuZXcgVVJMKCcuL3Jlc291cmNlcy9qcy9wbHVnaW5zL2Zha2UtYXBpL3V0aWxzLycsIGltcG9ydC5tZXRhLnVybCkpLFxuICAgIH0sXG4gIH0sXG4gIGJ1aWxkOiB7XG4gICAgY2h1bmtTaXplV2FybmluZ0xpbWl0OiA1MDAwLFxuICAgIG1pbmlmeTogZmFsc2UsIC8vIERlc2FiaWxpdGEgbWluaWZpY2FcdTAwRTdcdTAwRTNvIHNlIGZvciB1bSBlcnJvXG4gICAgc291cmNlbWFwOiB0cnVlLCBcbiAgfSxcbiAgb3B0aW1pemVEZXBzOiB7XG4gICAgZXhjbHVkZTogWyd2dWV0aWZ5J10sXG4gICAgZW50cmllczogW1xuICAgICAgJy4vcmVzb3VyY2VzL2pzLyoqLyoudnVlJyxcbiAgICBdLFxuICB9LFxufSlcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBK1gsT0FBTyxhQUFhO0FBQ25aLFNBQVMscUJBQXFCO0FBQzlCLE9BQU8sbUJBQW1CO0FBQzFCLE9BQU8sU0FBUztBQUNoQixPQUFPLFlBQVk7QUFDbkIsT0FBTyxnQkFBZ0I7QUFDdkIsT0FBTyxnQkFBZ0I7QUFDdkIsU0FBUyxzQkFBc0IsOEJBQThCO0FBQzdELE9BQU8sZUFBZTtBQUN0QixTQUFTLG9CQUFvQjtBQUM3QixPQUFPLGFBQWE7QUFDcEIsT0FBTyxhQUFhO0FBQ3BCLE9BQU8sZUFBZTtBQVo2TixJQUFNLDJDQUEyQztBQWNwUyxJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUMxQixTQUFTO0FBQUEsSUFDUCxVQUFVO0FBQUEsTUFDUixjQUFjLGVBQWE7QUFDekIsZUFBTyx1QkFBdUIsU0FBUyxFQUNwQyxRQUFRLHFCQUFxQixPQUFPLEVBQ3BDLFlBQVk7QUFBQSxNQUNqQjtBQUFBLE1BQ0Esa0JBQWtCLFVBQVE7QUFDeEIsYUFBSyxPQUFPLHVCQUF1QiwwQ0FBMEM7QUFDN0UsYUFBSyxPQUFPLHNCQUFzQiwwQ0FBMEM7QUFBQSxNQUM5RTtBQUFBLE1BQ0EsY0FBYztBQUFBLElBQ2hCLENBQUM7QUFBQSxJQUNELElBQUk7QUFBQSxNQUNGLFVBQVU7QUFBQSxRQUNSLGlCQUFpQjtBQUFBLFVBQ2YsaUJBQWlCLFNBQU8sUUFBUSxzQkFBc0IsUUFBUTtBQUFBLFFBQ2hFO0FBQUEsUUFDQSxvQkFBb0I7QUFBQSxVQUNsQixNQUFNO0FBQUEsVUFDTixpQkFBaUI7QUFBQSxRQUNuQjtBQUFBLE1BQ0Y7QUFBQSxJQUNGLENBQUM7QUFBQSxJQUNELFFBQVE7QUFBQSxNQUNOLE9BQU8sQ0FBQyxzQkFBc0I7QUFBQSxNQUM5QixTQUFTO0FBQUEsSUFDWCxDQUFDO0FBQUEsSUFDRCxPQUFPO0FBQUEsSUFDUCxRQUFRO0FBQUEsTUFDTixRQUFRO0FBQUEsUUFDTixZQUFZO0FBQUEsTUFDZDtBQUFBLElBQ0YsQ0FBQztBQUFBLElBQ0QsUUFBUTtBQUFBLE1BQ04sYUFBYTtBQUFBLElBQ2YsQ0FBQztBQUFBLElBQ0QsV0FBVztBQUFBLE1BQ1QsTUFBTSxDQUFDLGlDQUFpQyw0QkFBNEIseUJBQXlCO0FBQUEsTUFDN0YsS0FBSztBQUFBLE1BQ0wsV0FBVztBQUFBLFFBQ1QsbUJBQWlCO0FBQ2YsY0FBSSxrQkFBa0I7QUFDcEIsbUJBQU8sRUFBRSxNQUFNLFdBQVcsTUFBTSxtQkFBbUIsSUFBSSxnQkFBZ0I7QUFBQSxRQUMzRTtBQUFBLE1BQ0Y7QUFBQSxJQUNGLENBQUM7QUFBQSxJQUNELFdBQVc7QUFBQSxNQUNULFNBQVMsQ0FBQyxPQUFPLHNCQUFzQixnQkFBZ0IsZ0JBQWdCLFlBQVksT0FBTztBQUFBLE1BQzFGLE1BQU07QUFBQSxRQUNKO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLE1BQ0Y7QUFBQSxNQUNBLGFBQWE7QUFBQSxNQUNiLFFBQVEsQ0FBQyxjQUFjLFlBQVk7QUFBQSxNQUNuQyxVQUFVO0FBQUEsUUFDUixTQUFTO0FBQUEsUUFDVCxVQUFVO0FBQUEsTUFDWjtBQUFBLElBQ0YsQ0FBQztBQUFBLElBQ0QsY0FBYztBQUFBLE1BQ1osYUFBYTtBQUFBLE1BQ2IsaUJBQWlCO0FBQUEsTUFDakIsU0FBUztBQUFBLFFBQ1AsY0FBYyxJQUFJLElBQUksMENBQTBDLHdDQUFlLENBQUM7QUFBQSxNQUNsRjtBQUFBLElBQ0YsQ0FBQztBQUFBLElBQ0QsVUFBVTtBQUFBLEVBQ1o7QUFBQSxFQUNBLFFBQVEsRUFBRSxlQUFlLENBQUMsRUFBRTtBQUFBLEVBQzVCLFNBQVM7QUFBQSxJQUNQLE9BQU87QUFBQSxNQUNMLGNBQWMsY0FBYyxJQUFJLElBQUksNEJBQTRCLHdDQUFlLENBQUM7QUFBQSxNQUNoRixLQUFLLGNBQWMsSUFBSSxJQUFJLGtCQUFrQix3Q0FBZSxDQUFDO0FBQUEsTUFDN0QsZ0JBQWdCLGNBQWMsSUFBSSxJQUFJLG9CQUFvQix3Q0FBZSxDQUFDO0FBQUEsTUFDMUUsU0FBUyxjQUFjLElBQUksSUFBSSx3QkFBd0Isd0NBQWUsQ0FBQztBQUFBLE1BQ3ZFLFlBQVksY0FBYyxJQUFJLElBQUksMkJBQTJCLHdDQUFlLENBQUM7QUFBQSxNQUM3RSxXQUFXLGNBQWMsSUFBSSxJQUFJLHVCQUF1Qix3Q0FBZSxDQUFDO0FBQUEsTUFDeEUsV0FBVyxjQUFjLElBQUksSUFBSSx1QkFBdUIsd0NBQWUsQ0FBQztBQUFBLE1BQ3hFLHlCQUF5QixjQUFjLElBQUksSUFBSSwrQ0FBK0Msd0NBQWUsQ0FBQztBQUFBLE1BQzlHLE9BQU8sY0FBYyxJQUFJLElBQUksNkNBQTZDLHdDQUFlLENBQUM7QUFBQSxNQUMxRixjQUFjLGNBQWMsSUFBSSxJQUFJLDBDQUEwQyx3Q0FBZSxDQUFDO0FBQUEsSUFDaEc7QUFBQSxFQUNGO0FBQUEsRUFDQSxPQUFPO0FBQUEsSUFDTCx1QkFBdUI7QUFBQSxJQUN2QixRQUFRO0FBQUE7QUFBQSxJQUNSLFdBQVc7QUFBQSxFQUNiO0FBQUEsRUFDQSxjQUFjO0FBQUEsSUFDWixTQUFTLENBQUMsU0FBUztBQUFBLElBQ25CLFNBQVM7QUFBQSxNQUNQO0FBQUEsSUFDRjtBQUFBLEVBQ0Y7QUFDRixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
