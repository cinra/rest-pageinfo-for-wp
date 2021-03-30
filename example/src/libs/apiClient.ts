import axios from 'axios'
import aspida from '@aspida/axios'
import api from 'pageinfo-docs'

const apiClient = api(
  aspida(axios, {
    baseURL: 'http://127.0.0.1:8080/wp-json/wp/v2/'
  })
)

export default apiClient
