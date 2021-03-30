import { PageInfo } from '../@types'

export interface Methods {
  get: {
    query: {
      preview?: boolean
      preview_revision_id?: string
    }
    resBody: PageInfo
  }
}
