export interface IErrors {
    title?: string;
    content?: string;

    [key: string]: string | undefined;
}

export interface IForm {
    title: string;
    content: string;
}
