import React from 'react';
import {render, screen} from '@testing-library/react';
import '@testing-library/jest-dom';  // Import jest-dom for custom matchers
import App from './App';  // Adjust the path if necessary

test('renders Task Manager header', () => {
    render(<App/>);
    const headerElement = screen.getByText(/Task Manager/i);  // Adjust this text based on what App renders
    expect(headerElement).toBeInTheDocument();
});
