export interface PageInfo {
    current: string;
    the_id: number;
    is_home: boolean;
    is_page: boolean;
    is_single: boolean;
    is_archive: boolean;
    is_404: boolean;
    preview_revision_id: string;
    meta: string[];
    nonce?: string;
}
